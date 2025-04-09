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
use App\Models\SalaryExpectation;

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

    public function benefitsPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['benefits_preferences_data'] = DB::table("benefits_preferences")->where("subbenefit_id","0")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        
        return view('nurse.benefits_preferences')->with($data);
    }

    public function updateBenefitsPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $benefits_preferences = json_encode($request->benefits_preferences);
        

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['benefits_preferences'=>$benefits_preferences]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->benefits_preferences = $benefits_preferences;
            
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function locationPreferences()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['countries_data'] = DB::table("countries")->where("other","1")->get();
        $data['countries_data_other'] = DB::table("countries")->where("other","!=","1")->get();
        $data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        return view('nurse.location_preferences')->with($data);
    }

    public function updateLocationPreferences(Request $request)
    {
        $user_id = $request->user_id;
        $countries = json_encode($request->countries);
        
        
        //print_r($request->other_countries);die;
        if($request->other_countries != NULL){
            $other_countries1 = json_encode($request->other_countries);
        }else{
            $other_countries1 = '';
        }

        $work_preferences_data = WorkPreferencesModel::where("user_id",$user_id)->first();

        //print_r($work_preferences_data);

        if(!empty($work_preferences_data)){
            $run = WorkPreferencesModel::where('user_id',$user_id)->update(['countries'=>$countries,'other_countries'=>$other_countries1]);
        }else{
            $work_preferences = new WorkPreferencesModel();
            $work_preferences->user_id = $user_id;
            $work_preferences->countries = $countries;
            $work_preferences->other_countries = $other_countries1;
            $run = $work_preferences->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

    public function salaryExpectations()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['salary_expectation_data'] = SalaryExpectation::where("user_id",$user_id)->first();
        return view('nurse.salary_expectations')->with($data);
    }

    public function updatesalaryExpectations(Request $request)
    {
        $user_id = $request->user_id;
        $payment_frequency = $request->payment_frequency;
        $salary_range = $request->salary_range;
        $fixed_salary_amount = $request->fixed_salary_amount;
        $negotiable_salary = isset($request->negotiable_salary)?1:0;
        $hourly_salary_amount = $request->hourly_salary_amount;
        $weekly_salary_amount = $request->weekly_salary_amount;
        $monthly_salary_amount = $request->monthly_salary_amount;
        $annual_salary_amount = $request->annual_salary_amount;

        $salary_expectation_data = SalaryExpectation::where("user_id",$user_id)->first();


        if(!empty($salary_expectation_data)){
            $run = SalaryExpectation::where('user_id',$user_id)->update(['payment_frequency'=>$payment_frequency,'salary_range'=>$salary_range,'fixed_salary'=>$fixed_salary_amount,'negotiable_salary'=>$negotiable_salary,'hourly_salary'=>$hourly_salary_amount,'weekly_salary'=>$weekly_salary_amount,'monthly_salary'=>$monthly_salary_amount,'annual_salary'=>$annual_salary_amount]);
        }else{
            $salary_expectation = new SalaryExpectation();
            $salary_expectation->user_id = $user_id;
            $salary_expectation->payment_frequency = $payment_frequency;
            $salary_expectation->salary_range = $salary_range;
            $salary_expectation->fixed_salary = $fixed_salary_amount;
            $salary_expectation->negotiable_salary = $negotiable_salary;
            $salary_expectation->hourly_salary = $hourly_salary_amount;
            $salary_expectation->weekly_salary = $weekly_salary_amount;
            $salary_expectation->monthly_salary = $monthly_salary_amount;
            $salary_expectation->annual_salary = $annual_salary_amount;
            $run = $salary_expectation->save();
        }

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
        
    }

    public function match_percentage()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        //$data['work_preferences_data'] = WorkPreferencesModel::where("user_id",$user_id)->first();
        $data['score'] = $this->calculateCategory1Score($user_id);
        $data['score_percent'] = $data['score']/15*100;

        $data['specialities_score'] = $this->calculatespecialitiesScore($user_id);
        return view('nurse.match_percentage')->with($data);
    }

    public function calculateCategory1Score($user_id){
        $user_data = DB::table("users")->where("id",$user_id)->first();
        //print_r(json_decode($user_data->nurseType));die;
        $nurseType = json_decode($user_data->nurseType);
        $nurse_role = array();
        if($user_data->entry_level_nursing != "null"){
            $nurse_role1 = json_decode($user_data->entry_level_nursing);
        }else{
            $nurse_role1 = array();
        }

        if($user_data->registered_nurses != "null"){
            $nurse_role2 = json_decode($user_data->registered_nurses);
        }else{
            $nurse_role2 = array();
        }
        
        if($user_data->advanced_practioner != "null"){
            $nurse_role3 = json_decode($user_data->advanced_practioner);
        }else{
            $nurse_role3 = array();
        }

        if($user_data->nurse_prac != "null"){
            $nurse_role4 = json_decode($user_data->nurse_prac);
        }else{
            $nurse_role4 = array();
        }

        $merged = array_merge($nurse_role1, $nurse_role2, $nurse_role3, $nurse_role4);

        $nt_name = array();
        foreach($nurseType as $nt){
            $nt_data = DB::table("practitioner_type")->where("id",$nt)->first();
            $nt_name[] = $nt_data->name;
        }

        $nt_role = array();
        foreach($merged as $nr){
            $nr_data = DB::table("practitioner_type")->where("id",$nr)->first();
            //echo $nr;
            $nt_role[] = $nr_data->name;
        }
        
        //print_r($nt_role);
        $nurseProfile = array("categories"=>$nt_name,"special_roles"=>$nt_role);

        $jobsData = DB::table("jobs")->get();
        //print_r($nurseProfile);
        $jobcat_arr = array();
        foreach($jobsData as $jdata){
            $jobcat_arr[] = $jdata->job_category;
            
        }

        $jobrole_arr = array();
        foreach($jobsData as $jdata){
            $jobrole_arr[] = $jdata->job_role;
            
        }
        
        $jobRequirements = array("categories"=>$jobcat_arr,"special_roles"=>$jobrole_arr);

        return $score = $this->calculateTypeOfNurseAndRoleScore($jobRequirements, $nurseProfile);
    }

    function calculateTypeOfNurseAndRoleScore($job, $nurse, $categoryWeight = 15) {
        $hierarchy = [
            'Entry level nursing' => 1,
            'Registered Nurses (RNs)' => 2,
            'Advanced Practice Registered Nurses (APRNs)' => 3,
            'Nurse Practitioner (NP):' => 4
        ];
        // print_r($job)."<br>";
        // print_r($nurse);
        // --- Nurse Category Matching ---
        $jobCategories = $job['categories']; // array
        $nurseCategories = $nurse['categories']; // array
        $categoryMatchScores = [];
        
        foreach ($jobCategories as $jobCat) {
            $jobCat = trim($jobCat);
            $bestScore = 0;
    
            foreach ($nurseCategories as $nurseCat) {
                $nurseCat = trim($nurseCat);
                if ($nurseCat === $jobCat) {
                    $bestScore = max($bestScore, 1.0);
                } elseif (
                    isset($hierarchy[$nurseCat], $hierarchy[$jobCat]) &&
                    $hierarchy[$nurseCat] > $hierarchy[$jobCat]
                ) {
                    $bestScore = max($bestScore, 0.7); // overqualified
                }
            }
    
            $categoryMatchScores[] = $bestScore;
        }
        //print_r($categoryMatchScores);
        $avgCategoryScore = count($categoryMatchScores) > 0
            ? array_sum($categoryMatchScores) / count($categoryMatchScores)
            : 0;
    
        // --- Special Role Matching ---
        $jobRoles = array_map('strtolower', $job['special_roles']);
        
        $nurseRoles = array_map('strtolower', $nurse['special_roles']);

        $roles = DB::table("practitioner_type")->whereIn("parent",array(1,2,3,179))->get();
        $rarr = array();
        foreach($roles as $rdata){
            $rarr[] = $rdata->name;
        }
        
        $relatedRoles = $rarr;

    
        $roleMatchScores = [];
        foreach ($job['special_roles'] as $jobRole) {
            //$jobRoleLower = strtolower($jobRole);
            $bestScore = 0;
            foreach ($nurse['special_roles'] as $nurseRole) {
                //$nurseRoleLower = strtolower($nurseRole);
                if ($nurseRole === $jobRole) {
                    $bestScore = 1.0;
                } elseif (in_array($nurseRole, $relatedRoles)) {
                    $bestScore = max($bestScore, 0.5);
                }
            }
            $roleMatchScores[] = $bestScore;
        }

        //print_r($roleMatchScores);
    
        $avgRoleScore = count($roleMatchScores) > 0
            ? array_sum($roleMatchScores) / count($roleMatchScores)
            : 0;
    
        // --- Flexibility Score ---
        $maxNurseLevel = max(array_map(fn($c) => $hierarchy[$c] ?? 0, $nurse['categories']));
        $maxJobLevel = max(array_map(fn($c) => $hierarchy[$c] ?? 0, $job['categories']));
        $flexibilityScore = $maxNurseLevel > $maxJobLevel ? 0.7 : 0.0;
    
        // --- Final Score ---
        $averageScore = ($avgCategoryScore + $avgRoleScore + $flexibilityScore) / 3;
        return $averageScore * $categoryWeight;
    }

    public function calculatespecialitiesScore($user_id){
        $jobSpecialities = DB::table("jobs")->get();
        $jobSpecArr = array();
        foreach($jobSpecialities as $jSpecialities){
            $jobSpec = json_decode($jSpecialities->job_specialities);
            foreach($jobSpec as $jSpec){
                $jobSpecArr[] = $jSpec;
            }

        }
        //print_r($jobSpecArr);
    }
}
