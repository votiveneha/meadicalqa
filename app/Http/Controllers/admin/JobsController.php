<?php

namespace App\Http\Controllers\admin;
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

use App\Models\JobsModel;

class JobsController extends Controller
{
    
    
    public function index()
    {
        return view("admin.add_jobs");
    }

    public function edit_jobs(Request $request)
    {
        $data['job_list'] = DB::table("job_boxes")->where("id",$request->id)->first();
        return view("admin.edit_jobs")->with($data);
    }

    public function jobList()
    {
        $data['job_list'] = DB::table("job_boxes")->get();
        return view("admin.job_list")->with($data);
    }

    public function addJobs(Request $request)
    {
        $nurse_type = $request->nurse_type;
        $typeofspeciality = $request->typeofspeciality;
        $degree = $request->degree;
        $location_name = $request->location_name;
        $agency_name = $request->agency_name;
        $experience_level = $request->experience_level;
        $sector = $request->sector;
        $emplyeement_type = $request->emplyeement_type;
        $emplyeement_positions = $request->emplyeement_positions;
        $shift_type = $request->shift_type;
        $work_environment = $request->work_environment;
        $benefits = $request->benefits;
        $salary = $request->salary;
        $application_submission_date = $request->application_submission_date;
        $urgent_hire_tag = isset($request->urgent_hire_tag)? 1: 0;

        $jobs = new JobsModel;
        $jobs->nurse_type = json_encode($nurse_type);
        $jobs->typeofspeciality = json_encode($typeofspeciality);
        $jobs->degree = json_encode($degree);
        $jobs->sector = $sector;
        $jobs->location_name = $location_name;
        $jobs->agency_name = $agency_name;
        $jobs->experience_level = $experience_level;
        $jobs->emplyeement_type = json_encode($emplyeement_type);
        $jobs->emplyeement_positions = json_encode($emplyeement_positions);
        $jobs->shift_type = json_encode($shift_type);
        $jobs->work_environment = json_encode($work_environment);
        $jobs->benefits = json_encode($benefits);
        $jobs->salary = $salary;
        $jobs->application_submission_date = $application_submission_date;
        $jobs->urgent_hire = $urgent_hire_tag;
        $run = $jobs->save();

        if($run){
            return response()->json(['status' => '1']);
        }
        

        
    }
}