<?php

namespace App\Http\Controllers\nurse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MatchHelper;

use App\Models\User;
use App\Models\JobsModel;
use App\Models\SpecialityModel;
use Illuminate\Support\Facades\Auth;
use DB;

class MatchController extends Controller
{
    /**
     * Calculate match score for a given user and job
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job   $job
     * @return \Illuminate\Http\JsonResponse
     */

    public function match_percentage()
    {
        
        $user = Auth::guard("nurse_middle")->user();
        $jobs = JobsModel::get();
        

        $data['education_certification_percent'] = $this->matchEducationPercent($jobs,$user);
        $data['experience_certification_percent'] = $this->matchExperiencePercent($jobs,$user);
        $workData = $this->matchWorkEnvironmentPercent($jobs,$user);

        $data['work_environment_percent'] = $workData['final_percent'];
        $data['work_environment_bar']     = $workData['bar_width'];
        

        //print_r($training_id_arr);

        


        //print_r($nurse_percent);die;
        return view('nurse.match_percentage')->with($data);
    }


    public function matchEducationPercent($jobs, $user)
    {
        // -------- COLLECT ALL JOB REQUIREMENTS -------- //
        $job_degree_arr        = [];
        $mandatorytraining_arr = [];
        $mandatoryeducation_arr = [];
        $award_recognitionarr   = [];

        foreach ($jobs as $job) {

            $job_degree_arr         = array_merge($job_degree_arr, (array) json_decode($job->degree, true));
            $mandatorytraining_arr  = array_merge($mandatorytraining_arr, (array) json_decode($job->mandatory_tarining, true));
            $mandatoryeducation_arr = array_merge($mandatoryeducation_arr, (array) json_decode($job->mandatory_education, true));
            $award_recognitionarr   = array_merge($award_recognitionarr, (array) json_decode($job->award_recognition, true));
        }

        // -------- USER DEGREE -------- //
        $user_degree = (array) json_decode($user->degree, true);
        $found_degree = empty(array_diff($user_degree, $job_degree_arr)) ? 1 : 0;

        // -------- USER TRAINING -------- //
        $training = DB::table("mandatory_training")->where("user_id", $user->id)->first();
        $training_data = json_decode($training->training_data, true);

        $training_id_arr = [];
        foreach ($training_data as $parent => $childs) {
            $training_id_arr[] = $parent;
            $training_id_arr = array_merge($training_id_arr, array_keys($childs));
        }

        $found_training = empty(array_diff($training_id_arr, $mandatorytraining_arr)) ? 1 : 0;

        // -------- USER EDUCATION -------- //
        $education_data = json_decode($training->education_data, true);
        $education_id_arr = [];
        foreach ($education_data as $parent => $childs) {
            $education_id_arr[] = $parent;
            $education_id_arr = array_merge($education_id_arr, array_keys($childs));
        }

        $found_education = empty(array_diff($education_id_arr, $mandatoryeducation_arr)) ? 1 : 0;

        // -------- USER AWARDS -------- //
        $award = DB::table("professional_membership")->where("user_id", $user->id)->first();
        $award_user_arr = [];

        foreach ((array) json_decode($award->award_recognitions) as $group) {
            foreach ($group as $a) {
                $award_user_arr[] = $a;
            }
        }

        $found_award = empty(array_diff($award_user_arr, $award_recognitionarr)) ? 1 : 0;

        // -------- MATCH PERCENT -------- //
        $match = $found_degree + $found_training + $found_education + $found_award;
        return round(($match / 4) * 15 / 100);
    }

    public function matchExperiencePercent($jobs, $user)
    {
        $user_experience = $user->assistent_level;
        

        $emplyeement_positionsarr = [];
        $experience_level_arr = [];
        foreach ($jobs as $job) {
            $experience_level_arr[] = $job->experience_level;
            foreach (json_decode($job->emplyeement_positions) as $emplyeement_positions) {
                $emplyeement_positionsarr[] = $emplyeement_positions;
            }
        }

        

        $found_experience = 0;
        if(in_array($user_experience,$experience_level_arr)){
            $found_experience = 1;
        }

        $user_position_data = DB::table("user_experience")->where("user_id", $user->id)->get();
        $user_positionsarr = [];
        
        foreach ($user_position_data as $user_position) {
            
            foreach (json_decode($user_position->position_held) as $position_held) {

                foreach($position_held as $position){
                    $user_positionsarr[] = $position;
                }
                
            }
        }

        $found_position = empty(array_diff($user_positionsarr, $emplyeement_positionsarr)) ? 1 : 0;

        //print_r($user_positionsarr);

        // -------- MATCH PERCENT -------- //
        $match = $found_experience + $found_position;
        return round(($match / 2) * 100);
    }

    public function matchWorkEnvironmentPercent($jobs, $user){
        $work_data = DB::table("work_preferences")->where("user_id",$user->id)->first();
        
        

        $sector_data = $work_data->sector_preferences;
        
        $sector_arr = [];
        $work_environmentarr = [];
        $jobemp_typearr = [];
        $jobshift_typearr = [];
        $jobpositionarr = [];
        $jobbenefitsarr = [];
        if(!empty($jobs)){
            foreach ($jobs as $job) {
                $sector_arr[] = $job->sector;
                if(!empty(json_decode($job->work_environment))){
                    foreach (json_decode($job->work_environment) as $work_environment) {
                        $work_environmentarr[] = $work_environment;
                        
                    }
                }

                if(!empty(json_decode($job->emplyeement_type))){
                    foreach (json_decode($job->emplyeement_type) as $emplyeement_type) {
                        $jobemp_typearr[] = $emplyeement_type;
                        
                    }
                }

                if(!empty(json_decode($job->shift_type))){
                    foreach (json_decode($job->shift_type) as $shift_type) {
                        $jobshift_typearr[] = $shift_type;
                        
                    }
                }

                if(!empty(json_decode($job->emplyeement_positions))){
                    foreach (json_decode($job->emplyeement_positions) as $emplyeement_positions) {
                        $jobpositionarr[] = $emplyeement_positions;
                        
                    }
                }

                if(!empty(json_decode($job->emplyeement_positions))){
                    foreach (json_decode($job->emplyeement_positions) as $emplyeement_positions) {
                        $jobpositionarr[] = $emplyeement_positions;
                        
                    }
                }

                if(!empty(json_decode($job->benefits))){
                    foreach (json_decode($job->benefits) as $benefits) {
                        $jobbenefitsarr[] = $benefits;
                        
                    }
                }
            }
        }

        //print_r(array_unique($jobbenefitsarr));

        //print_r($jobemp_typearr);

        $found_sector = 0;

        if(in_array($sector_data,$sector_arr)){
            $found_sector = 1;
        }

        
        $json = $work_data->work_environment_preferences;
        $data = json_decode($json, true);

        // Remove first-level key
        $inner = reset($data);

        $result = [];

        $this->getAllNumbers($inner, $result);

        $result = array_values(array_unique($result));



        //print_r($result);

        $found_work_environment = empty(array_diff($result, $work_environmentarr)) ? 1 : 0;

        //emp_type preferences

        $jobemp = array_unique($jobemp_typearr);
        $useremp = json_decode($work_data->emptype_preferences);
        $useremparr = [];
        foreach($useremp as $emp){
            foreach($emp as $emp1){
                $useremparr[] = $emp1;
            }
        }

        // print_r($jobemp);
        // print_r($useremparr);

        $found_emp_preferences = !empty(array_intersect($useremparr, $jobemp)) ? 1 : 0;   

        $jobemp = array_unique($jobshift_typearr);
        $usershift = (array)json_decode($work_data->work_shift_preferences);
        //print_r($usershift[1]);
        $usershift1 = isset($usershift[1])?$usershift[1]:[];

        $shift_data = [];

        if(!empty($usershift1)){
            foreach($usershift1 as $shift){
                $shift_data[] = $shift;
            }
        }

        $found_shift_type = empty(array_diff($shift_data, $jobshift_typearr)) ? 1 : 0;

        $jobposition = array_unique($jobpositionarr);
        $userposition = (array)json_decode($work_data->position_preferences);
        $userposition1 = (array)$userposition[1];
        $posdata = [];
        if(!empty($userposition1)){
            foreach($userposition1 as $index=>$userpos){
                $posdata[] = $index;
                foreach($userpos as $userpos1){
                    $posdata[] = $userpos1;
                }
            }
        }
        
        $found_position_type = !empty(array_intersect($posdata, $jobposition)) ? 1 : 0;
        //print_r($posdata);

        $json = $work_data->benefits_preferences;
        $data = json_decode($json, true);

        $secondArray = [];

        foreach ($data as $values) {
            foreach ($values as $v) {
                $secondArray[] = $v;
            }
        }

        //print_r($secondArray);
        $found_position_type = !empty(array_intersect($secondArray, $jobbenefitsarr)) ? 1 : 0;

        $match = $found_sector + $found_work_environment + $found_emp_preferences+$found_shift_type+$found_position_type+$found_position_type;
        
        $final_percent = round(($match / 5) * 30);
        $bar_width = ($match / 5) * 100;

        return [
            'final_percent' => $final_percent,
            'bar_width'     => $bar_width
        ];

        //echo $found_sector;


    }

    // Recursive function
    private function getAllNumbers($array, &$result)
    {
        foreach ($array as $key => $value) {

            // add key
            $result[] = $key;

            if (is_array($value)) {
                // go deeper
                $this->getAllNumbers($value, $result);
            } else {
                // add final value
                $result[] = $value;
            }
        }
    }

    public function matchedJobs(){

        $user = Auth::guard("nurse_middle")->user();
        $jobs = JobsModel::get();
        $data['jobs'] = $jobs;
        $workData = $this->matchSingleWorkEnvironmentPercent($jobs,$user);

        $data['employeement_type_data'] = DB::table("employeement_type_preferences")->where("sub_prefer_id",0)->get();
        $data['shift_type_data'] = DB::table("work_shift_preferences")->where("shift_id",0)->where("sub_shift_id",NULL)->get();
        $data['employee_positions'] = DB::table("employee_positions")->where("subposition_id",0)->get();
        $data['benefits_preferences'] = DB::table("benefits_preferences")->where("subbenefit_id",0)->get();
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
        $data['saved_searches_data'] = DB::table("saved_searches")
            ->where("user_id", $user_id)
            ->get();       
        return view("nurse.matchedjobsnew")->with($data);
    }

    public function matchSingleWorkEnvironmentPercent($jobs,$user)
    {

    }


}
