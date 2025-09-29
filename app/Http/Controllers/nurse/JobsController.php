<?php

namespace App\Http\Controllers\nurse;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;
use App\Services\Admins\SpecialityServices;
use Illuminate\Support\Facades\Storage;


class JobsController extends Controller{
    
    public function index()
    {
        $data['employeement_type_data'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",0)->get();
        $data['shift_type_data'] = DB::table("work_shift_preferences")->where("shift_id",0)->where("sub_shift_id",NULL)->get();
        $data['work_environment_data'] = DB::table("work_enviornment_preferences")
            ->where("sub_env_id", 0)
            ->where("sub_envp_id", 0)
            ->get();
        $data['work_shift_data'] = DB::table("work_shift_preferences")
            ->where("shift_id", 0)
            ->where("sub_shift_id", NULL)
            ->get();    
        $data['type_of_nurse'] = DB::table("practitioner_type")
            ->where("parent", 0)
            ->get();        
        $data['speciality'] = DB::table("speciality")
            ->where("parent", 0)
            ->get();     
        $user_id = Auth::guard('nurse_middle')->user()->id;    
        $data['work_preferences_data'] = DB::table("work_preferences")
            ->where("user_id", $user_id)
            ->first();    
        if($data['work_preferences_data']->location_status == "International relocation"){    
            $international_location = json_decode($data['work_preferences_data']->countries);
            $country_name_arr = [];
            if(!empty($international_location)){
                foreach($international_location as $inter_loc){
                    if($inter_loc != "Other"){
                        $countdata = DB::table("countries")->where("id",$inter_loc)->first();
                        $country_name_arr[] = $countdata->name; 
                    }
                }
            }    
            $other_countries = [];
            if (in_array("Other", $international_location)) {
                $other_location = json_decode($data['work_preferences_data']->other_countries);
                foreach($other_location as $other_loc){
                    $countdata = DB::table("countries")->where("id",$other_loc)->first();
                    $other_countries[] = ucwords(strtolower($countdata->name)); 
                    
                }
                
            }
            
            $data['location_status'] = "international_location";
            $country_merge = array_merge($country_name_arr, $other_countries);
        }

        if($data['work_preferences_data']->location_status == "Current Location area (not willing to relocate)"){
            $address = $data['work_preferences_data']->prefered_location_current;
            $parts = explode(",", $address);
            $country_merge = trim(end($parts));
            $data['location_status'] = "current_location";
        }

        

        if($data['work_preferences_data']->location_status == "Multiple locations area (relocation within your country)"){
            $address = json_decode($data['work_preferences_data']->prefered_location);
            $country_merge = [];
            if(!empty($address)){
                foreach($address as $add){
                    
                    $parts = explode(",", $add->location);
                    $country_merge[] = trim(end($parts));
                }
            }
            
            $data['location_status'] = "multiple_location";
        }

        if($data['work_preferences_data']->location_status == NULL){
            $country_merge = '';
            $data['location_status'] = "";
        }
        
        $data['country_name'] = $country_merge;
        $data['user_data'] = DB::table("users")->where("id",$user_id)->first();
                   
        $data['jobs'] = DB::table("job_boxes")->get();                
        return view('nurse.find_jobs')->with($data);
    }

    public function capitalizeFirstTwo($string) {
        $result = '';
        $words = explode(' ', strtolower($string)); // split words, normalize to lowercase
        foreach ($words as $word) {
            $part1 = strtoupper(substr($word, 0, 2)); // first 2 letters uppercase
            $part2 = substr($word, 2);               // rest normal
            $result .= $part1 . $part2 . ' ';
        }
        return trim($result);
    }

    public function getWorkFlexiblityData(Request $request)
    {
        $table_name = $request->table_name;
        $column_name = $request->column_name;
        $main_column_id = $request->main_column_id;
        $column_type = $request->column_type;

        $employeement_type_data = DB::table($table_name)->where($column_name,0)->get()->map(function ($item) {
            return (array) $item;
        })->toArray();
        //print_r($employeement_type_data);die;
        $nested = [];
        foreach($employeement_type_data as $employeement_type){
            $subemp_type = DB::table($table_name)->where($column_name,$employeement_type[$main_column_id])->get();
            $nested[] = [
                'id' => $employeement_type[$main_column_id],
                'name' => $employeement_type[$column_type], // Adjust field names as per your DB
                'sub_types' => $subemp_type->map(function($item) use ($main_column_id, $column_type) {
                    $items = (array)$item;
                    return [
                        'id' => $items[$main_column_id],
                        'name' => $items[$column_type] // Adjust as needed
                    ];
                })
            ];
        }

        $user_id = Auth::guard('nurse_middle')->user()->id;    
        $work_preferences_data = DB::table("work_preferences")
            ->where("user_id", $user_id)
            ->first();    

        $response = [
            'filters'     => $nested,
            'preferences' => $work_preferences_data,
        ];

           

        // Convert to JSON (optional)
        $json = json_encode($response, JSON_PRETTY_PRINT);

        return $json;

    }

    public function getWorkEnvironmentData(Request $request)
    {
        $employeement_type_data = DB::table("work_enviornment_preferences")
            ->where("sub_env_id", 0)
            ->where("sub_envp_id", 0)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        $nested = [];

        foreach ($employeement_type_data as $employeement_type) {
            $subemp_type = DB::table("work_enviornment_preferences")
                ->where("sub_env_id", $employeement_type['prefer_id'])
                ->where("sub_envp_id", 0)
                ->get();

            $nested[] = [
                'id' => $employeement_type['prefer_id'],
                'name' => $employeement_type['env_name'],
                'sub_types' => $subemp_type->map(function ($item) {
                    $items = (array) $item;

                    // Third level: subsub_types
                    $subsub_type = DB::table("work_enviornment_preferences")
                        ->where("sub_envp_id", $items['prefer_id']) // 3rd level based on sub_envp_id
                        ->get()
                        ->map(function ($third) {
                            $third_item = (array) $third;
                            return [
                                'id' => $third_item['prefer_id'],
                                'name' => $third_item['env_name']
                            ];
                        });

                    return [
                        'id' => $items['prefer_id'],
                        'name' => $items['env_name'],
                        'subsub_types' => $subsub_type
                    ];
                })
            ];
        }

        $json = json_encode($nested, JSON_PRETTY_PRINT);

        // Return as JSON
        return $json;
    }

    public function getJobsSorting(Request $request){
        $sort_name = $request->sort_name;

        if($sort_name == "most_recent"){
            $data['jobs'] = DB::table("job_boxes")->orderBy('id','desc')->get();
        }

        if($sort_name == "urgent_hire"){
            $data['jobs'] = DB::table("job_boxes")->orderBy('urgent_hire','desc')->get();
            //print_r($data['jobs']);die;
        }

        if($sort_name == "application_deadline"){
            $data['jobs'] = DB::table("job_boxes")->orderBy('application_submission_date','asc')->get();
            //print_r($data['jobs']);die;
        }
        
        return view("nurse.job_filter_data")->with($data);
    }

    public function getNurseData(Request $request)
    {
        $nurse_id = $request->nurse_id;
        $nurse_data = DB::table("practitioner_type")->where("parent",$nurse_id)->get();
        
        $ndatas = array();
        foreach($nurse_data as $ndata){
            
            $nsubarr = array();
            $get_nurse_count = DB::table("practitioner_type")->where("parent",$ndata->id)->get();

            foreach($get_nurse_count as $get_nurse){
                $nsubarr[] = array("id"=>$get_nurse->id,"name"=>$get_nurse->name,"parent"=>$get_nurse->parent);
            }
            
            $ndatas[] = array("id"=>$ndata->id,"name"=>$ndata->name,"parent"=>$ndata->parent,"get_nurse_count"=>count($get_nurse_count),"get_nurse"=>$nsubarr);
        }
        return json_encode($ndatas);
    }

    public function getSpecialityData(Request $request)
    {
        $specality_id = $request->speciality_id;
        $specality_data = DB::table("speciality")->where("parent",$specality_id)->get();
        
        $specdatas = array();
        foreach($specality_data as $specdata){
            
            $specsubarr = array();
            $get_spec_count = DB::table("speciality")->where("parent",$specdata->id)->get();

            foreach($get_spec_count as $get_spec){
                $specsubarr[] = array("id"=>$get_spec->id,"name"=>$get_spec->name,"parent"=>$get_spec->parent);
            }
            
            $specdatas[] = array("id"=>$specdata->id,"name"=>$specdata->name,"parent"=>$specdata->parent,"get_spec_count"=>count($get_spec_count),"get_spec"=>$specsubarr);
        }
        return json_encode($specdatas);
    }

    public function getFilterData(Request $request){
        $filter_name = $request->filter_name;
        $searchValues = $request->selectedValues;
        $selectedValues = $request->selectedValues;
        //print_r($selectedValues);die;

        
        if($filter_name == "Employment Type"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('emplyeement_type', (string) $id);
                }
            })->get();
            
        }    

        if($filter_name == "Position"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('emplyeement_positions', (string) $id);
                }
            })->get();
        }    

        if($filter_name == "Benefits"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('benefits', (string) $id);
                }
            })->get();
        }    
        //print_r($jobs);
        
        if($filter_name == "sector"){
            $data['jobs'] = DB::table("job_boxes")->whereIn("sector",$selectedValues)->get();
        }    
        //print_r($data);die;
        return view("nurse.job_filter_data")->with($data);

    }

    public function getExperienceData(Request $request){
        $experience = $request->experience;

        $data['jobs'] = DB::table("job_boxes")->where("experience_level",$experience)->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function getFilterNurseData(Request $request){
        $nurse_data = $request->nurse_data;

        $data['jobs'] = DB::table('job_boxes')
        ->where(function($query) use ($nurse_data) {
            foreach ($nurse_data as $value) {
                $query->orWhere('nurse_type', 'LIKE', '%"'.$value.'"%');
            }
        })
        ->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function getFilterSpecialityData(Request $request){
        $speciality_data = $request->speciality_data;

        $data['jobs'] = DB::table('job_boxes')
        ->where(function($query) use ($speciality_data) {
            foreach ($speciality_data as $value) {
                $query->orWhere('typeofspeciality', 'LIKE', '%"'.$value.'"%');
            }
        })
        ->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function updateSectorData(Request $request){
        $sector_data = $request->sector_data;

        $user_id = Auth::guard("nurse_middle")->user()->id;

        $updateWorkPreferencesFlexiblity = DB::table("work_preferences")->where("user_id",$user_id)->update(['sector_preferences'=>$sector_data]);
    }

    public function applyJobs(Request $request){
        $user_id = $request->user_id;
        $job_id = $request->job_id; 

        $applyJobs = DB::table("job_apply")->insert(["user_id"=>$user_id,"job_id"=>$job_id]);

        if($applyJobs == 1){
            return $applyJobs;
        }
    }

}
