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
        $nurse_type_data = [];
        $job_degree_arr = [];
        foreach($jobs as $job){
            if(!empty(json_decode($job->degree))){
                foreach(json_decode($job->nurse_type) as $ntype){
                    $nurse_type_data[] = $ntype;
                    
                }
            }
            if(!empty(json_decode($job->degree))){
                foreach(json_decode($job->degree) as $dtype){
                    $job_degree_arr[] = $dtype;
                    
                }
            }
        }

        $nurse_data = json_decode($user->nurse_data);
        $nurse_data_arr = [];
        $practitioner_data = SpecialityModel::get();
        foreach($nurse_data as $index=>$ndata){
            
            foreach($ndata as $ndata1){
                $nurse_data_arr[] = $ndata1;
            }
        }
        
        //print_r($job_degree_arr);
        $found = 0;
        //for education
        $user_degree = json_decode($user->degree);
        //print_r($user_degree);
        if (!array_diff($user_degree, $job_degree_arr)) {
            $found = 1;
        }

        $mandatory_training = DB::table("mandatory_training")->where("user_id",$user->id)->first();
        $training_data = json_decode($mandatory_training->training_data);
        foreach ($training_data as $id1 => $inner) {
            echo "First ID: " . $id1 . "<br>";        // 417

            foreach ($inner as $id2 => $details) {
                echo "Second ID: " . $id2 . "<br>";   // 490
            }
        }

        


        //print_r($nurse_percent);die;
        return view('nurse.match_percentage');
    }


    public function calculateJobMatch(User $user, JobsModel $job)
    {
        // echo "<pre>";
        
    }

}
