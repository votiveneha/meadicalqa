<?php

namespace App\Http\Controllers\nurse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MatchHelper;
use App\Models\User;
use App\Models\JobsModel;
use App\Models\SpecialityModel;
use Illuminate\Support\Facades\Auth;

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
        foreach($jobs as $job){
            foreach(json_decode($job->nurse_type) as $ntype){
                $nurse_type_data[] = $ntype;
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
        
        print_r($nurse_data_arr);
        //print_r($nurse_percent);die;
        return view('nurse.match_percentage');
    }


    public function calculateJobMatch(User $user, JobsModel $job)
    {
        // echo "<pre>";
        
    }

}
