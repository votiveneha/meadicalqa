<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\MembershipTypeRequest;
use App\Http\Requests\AwardsRequest;
use App\Services\Admins\LanguageSkillsServices;
use App\Repository\Eloquent\LanguageSkillsRepository;

class LanguageSkillsController extends Controller{
    protected $language_skills_services;
    protected $language_skills_repository;
  
    public function __construct(LanguageSkillsServices $language_skills_services , LanguageSkillsRepository $language_skills_repository){
        $this->language_skills_services = $language_skills_services;
        $this->language_skills_repository = $language_skills_repository;
       
    }

    public function language_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>NULL,'test_id'=>NULL]);
            

            return view('admin.language_list',compact('languageData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addLanguages(LanguageRequest $request)
    {
        
        try {
         
            return $this->language_skills_services->addLanguages($request);
         } catch (\Exception $e) {
             log::error('Error in DegreeController/addDegree :' . $e->getMessage() . 'in line' . $e->getLine());
             return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
         }
    }

    public function getLanguages(Request $request)
    {
        try {
           return $this->language_skills_repository->get(['language_id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/getDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function deleteLanguages(Request $request)
    {
        try {
           return $this->language_skills_services->deleteLanguages($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/deleteDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function updateLanguages(LanguageRequest $request)
    {
        
        try {
           return $this->language_skills_services->updateLanguages($request);
        } catch (\Exception $e) {
            log::error('Error in DegreeController/updateDegree :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function sub_language_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>$request->id,'test_id'=>NULL]);
            $data['languageData'] = $languageData;
            $data['language_id'] = $request->id;
            return view('admin.sub_language_list')->with($data);
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function certification_list(Request $request)
    {
        
        try {
            $languageData  =  $this->language_skills_repository->getAll(['sub_language_id'=>NULL,['test_id', '!=', null]]);
            
            return view('admin.certification_list',compact('languageData'));
        } catch (\Exception $e) {
            log::error('Error in ProfessionalMembership/countryList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }


}    