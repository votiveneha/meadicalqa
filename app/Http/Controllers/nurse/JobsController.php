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
        return view('nurse.find_jobs')->with($data);
    }

    public function getWorkFlexiblityData(Request $request)
    {
        $table_name = $request->table_name;
        $column_name = $request->column_name;
        $main_column_id = $request->main_column_id;
        

        $employeement_type_data = DB::table($table_name)->where($column_name,0)->get();
        print_r((array)$employeement_type_data);die;
        $nested = [];
        foreach($employeement_type_data as $employeement_type){
            $subemp_type = DB::table("employeement_type_preferences")->where("sub_prefer_id",$employeement_type[$main_column_id])->get();
            $nested[] = [
                'id' => $employeement_type[$main_column_id],
                'name' => $employeement_type->emp_type, // Adjust field names as per your DB
                'sub_types' => $subemp_type->map(function($item) {
                    return [
                        'id' => $item->emp_prefer_id,
                        'name' => $item->emp_type // Adjust as needed
                    ];
                })
            ];
        }


        // Convert to JSON (optional)
        $json = json_encode($nested, JSON_PRETTY_PRINT);

        return $json;

    }
}
