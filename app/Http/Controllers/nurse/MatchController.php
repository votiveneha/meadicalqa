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
        $data['work_environment_percent'] = $this->matchWorkEnvironmentPercent($jobs,$user);
        

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
        if(!empty($jobs)){
            foreach ($jobs as $job) {
                $sector_arr[] = $job->sector;
                foreach (json_decode($job->work_environment) as $work_environment) {
                    $work_environmentarr[] = $work_environment;
                    
                }
            }
        }

        //print_r(array_unique($work_environmentarr));

        //print_r($sector_arr);

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




        $match = $found_sector + $found_work_environment;
        return round(($match / 2) * 30/100);


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


}
