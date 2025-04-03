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
use App\Models\LanguageModel;
use App\Models\LanguageSkillsModel;

class LanguageSkillsContoller extends Controller{

    public function index()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $data['language_data'] = LanguageModel::where("sub_language_id",NULL)->where("test_id",NULL)->orderBy("language_name","ASC")->get();
        $data['test_data'] = LanguageModel::where("test_id","1")->orderBy("language_name","ASC")->get();
        $data['other_test_data'] = LanguageModel::where("test_id","2")->orderBy("language_name","ASC")->get();
        $data['specialized_lang_skills'] = LanguageModel::where("test_id","3")->orderBy("language_name","ASC")->get();
        $data['language_skills'] = LanguageSkillsModel::where("user_id",$user_id)->first();
        return view('nurse.language_skills')->with($data);
    }

    public function getLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['main_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        
        $data['language_data'] = LanguageModel::where("sub_language_id",$language_id)->orderBy("language_name","ASC")->get();
        //print_r(json_encode($data['language_data']));
        return json_encode($data);
    }

    public function getSubLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['sub_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        
        //print_r(json_encode($data['language_data']));
        return json_encode($data);
    }

    public function getTestLanguagesData(Request $request)
    {
        $language_id = $request->language_id;
        $data['test_language_data'] = LanguageModel::where("language_id",$language_id)->first();
        $data['language_id'] = $language_id;
        return json_encode($data);
    }

    public function updateLanguageSkills(Request $request)
    {
        $user_id = $request->user_id;
        $langprof_level = json_encode($request->langprof_level);
        $english_prof_cert = json_encode($request->english_prof_cert);
        $other_prof_cert = json_encode($request->otherlangprof);
        $specialized_lang_skills = json_encode($request->specialized_lang_skills);

        //print_r($english_prof_cert);
        $language_skills = new LanguageSkillsModel();
        $language_skills->user_id = $user_id;
        $language_skills->langprof_level = $langprof_level;
        $language_skills->english_prof_cert = $english_prof_cert;
        $language_skills->other_prof_cert = $other_prof_cert;
        $language_skills->specialized_lang_skills = $specialized_lang_skills;
        $run = $language_skills->save();

        if ($run) {
            $json['status'] = 1;
            
        } else {
            $json['status'] = 0;
            
        }

        echo json_encode($json);
    }

}