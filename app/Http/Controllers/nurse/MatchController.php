<?php

namespace App\Http\Controllers\nurse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MatchHelper;
use App\Models\User;
use App\Models\JobsModel;
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
        $jobs = JobsModel::first();
        $data['nurse_percent'] = $this->calculateJobMatch($user,$jobs);
        //print_r($nurse_percent);die;
        return view('nurse.match_percentage')->with($data);
    }


    public function calculateJobMatch(User $user, JobsModel $job)
    {
        // echo "<pre>";
        // print_r($user);die;
        $score = \App\Helpers\MatchHelper::calculateTypeOfNurseAndRole(
            $user->nurseType,     // stored JSON
            $user->special_role,   // stored JSON or string
            $job->nurse_type,      // stored JSON
            $job->roleofspeciality // stored JSON
        );

        return [
            'category' => 'Type of Nurse & Role',
            'score' => $score,
            'out_of' => 15
        ];
    }

}
