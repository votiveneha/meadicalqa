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
use App\Models\WorkPreferencesModel;

class WorkPreferencesController extends Controller{

    public function index()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        return view('nurse.sector_preferences')->with($data);
    }

    public function updateSectorPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $sector_preferences = $request->sector_preferences;

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['sector_preferences'=>$sector_preferences]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->sector_preferences = $sector_preferences;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function work_environment_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        return view('nurse.work_environment_preferences')->with($data);
    }

    public function updateWorkPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $subworkthlevel = json_encode($request->subworkthlevel);

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['work_environment_preferences'=>$subworkthlevel]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->work_environment_preferences = $subworkthlevel;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function employeement_type_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id","0")->get();
        
        //print_r($data['employeement_type_preferences']);die;
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();

        if(!empty($data['work_preferences_data'] && $data['work_preferences_data']->emptype_preferences != NULL)){
            $emptype_data = (array)json_decode($data['work_preferences_data']->emptype_preferences);
            //print_r($emptype_data);
            $emptypeid = '';
            foreach($emptype_data as $index=>$empdata){
                $data['emptypeid'] = $index;
                $data['emptypearr'] = json_encode($empdata);
                $data['subemployeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",$index)->get();
                $subemployeement_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$index)->first();
                $data['subemployeement_name'] = $subemployeement_name->emp_type;
            }   
        }else{
            $data['emptypeid'] = '';
        }
        
        

        return view('nurse.employeement_type_preferences')->with($data);
    }

    public function getEmpData(Request $request)
    {
        $sub_prefer_id = $request->sub_prefer_id;
        $employeement_type_name = DB::table("employeement_type_preferences")->where("emp_prefer_id",$sub_prefer_id)->first();
        
        
        $data['employeement_type_preferences'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",$sub_prefer_id)->get();
        
        
        //print_r($employeement_type_preferences);die;
        $data['employeement_type_name'] = $employeement_type_name->emp_type;
        return json_encode($data);
    }

    public function updateEmpTypePreferences(Request $request)
    {
        $user_id = $request->user_id;
        $emptype_preferences = $request->emptype_preferences;
        $emptypelevel = json_encode($request->emptypelevel);

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['emptype_preferences'=>$emptypelevel]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->emptype_preferences = $emptypelevel;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function WorkShiftPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.work_shift_preferences')->with($data);
    }

    public function getSubWorkData(Request $request)
    {
        $shift_id = $request->shift_id;
        $sub_shift_id = $request->sub_shift_id;

        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id",$shift_id)->where("sub_shift_id",$sub_shift_id)->get();
        //print_r($data['shift_preferences_data']);die;
        
        if(!empty($data['shift_preferences_data'])){
            $shift_preferences_name = DB::table("work_shift_preferences")->where("shift_id",$shift_id)->where("work_shift_id",$sub_shift_id)->first();
            $data['shift_preferences_name'] = $shift_preferences_name->shift_name;
            $data['sub_shift_id'] = $sub_shift_id;
            return json_encode($data);
        }
        
    }

    public function updateShiftPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $workshift_preferences = json_encode($request->shift_preferences);

        if(isset($request->shift_preferences1)){
            $subworkshift_preferences = json_encode($request->shift_preferences1);
        }else{
            $subworkshift_preferences = '';
        }

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['work_shift_preferences'=>$workshift_preferences,'subwork_shift_preferences'=>$subworkshift_preferences]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->work_shift_preferences = $workshift_preferences;
            $work_preferences->subwork_shift_preferences = $subworkshift_preferences;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function position_preferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['shift_preferences_data'] = DB::table("work_shift_preferences")->where("shift_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.position_preferences')->with($data);
    }

    public function updatePositionPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $subpositions_held = json_encode($request->subpositions_held);
        

        

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['position_preferences'=>$subpositions_held]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->position_preferences = $subpositions_held;
            
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }
}