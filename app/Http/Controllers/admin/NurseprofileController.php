<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;

use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\NdisWorker;
use App\Models\SpecializedClearance;
use App\Models\SubClassModel;
use App\Models\PoliceCheckModel;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\MandatoryTrainModel;
use Carbon\Carbon;
use File;
use DB;
use Helpers;

class NurseprofileController extends Controller
{
    protected $nurseRepository;
    protected $nurseServices;
    protected $verificationRepository;

    public function __construct(NurseRepository $nurseRepository, NurseServices $nurseServices, VerificationRepository $verificationRepository)
    {
        $this->nurseRepository = $nurseRepository;
        $this->nurseServices = $nurseServices;
        $this->verificationRepository = $verificationRepository;
    }

    public function setting_availablity_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        return view('admin.setting_availability_view')->with($data);
    }

    public function profession_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        return view('admin.view_profession')->with($data);
    }

    public function education_certification(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['educationData']  = $this->nurseRepository->getEducationCerdetails(['user_id' => $request->id]);
        return view('admin.education_certification_view')->with($data);
    }

    public function registration_licenses(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['licensesData']  = DB::table('user_licenses_details')->where("user_id",$request->id)->first();
        //print_r($data['licensesData']);
        return view('admin.registration_licenses_view')->with($data);
    }

    public function ahpra_reverify(Request $request)
    {
        DB::table('user_licenses_details')->where("user_id",$request->user_id)->update(["ahpra_reverify"=>$request->ahpra_reverify]);
    }

    public function experience_view(Request $request)
    {
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['experienceData']  = DB::table("user_experience")->where("user_id", $request->id)->get();
        //print_r($data['licensesData']);
        return view('admin.view_experience')->with($data);
    }

    public function professional_membership(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['professional_membership']  = DB::table("professional_membership")->where("user_id", $request->id)->first();
        // echo "<pre>";
        // print_r($data['professional_membership']);
        return view('admin.view_professional_membership')->with($data);
    }

    public function language_skills(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['language_skills']  = DB::table("language_skills")->where("user_id", $request->id)->first();
        // echo "<pre>";
        // print_r($data['professional_membership']);
        return view('admin.view_language_skills')->with($data);
    }

    public function view_references(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['RefereData']  = $this->nurseRepository->getReferedetails(['user_id' => $request->id]);
        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.references_view')->with($data);
    }

    public function vaccination_view(Request $request)
    {
        $data['other_vaccine']      = DB::table("other_vaccine")->where("user_id", $request->id)->get();   
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);
        $data['vaccinationData']    = DB::table("vaccination_front")->where("user_id", $request->id)->get();
        $data['vccdata']            = DB::table('vaccination_front as vc')
                                    ->select('vc.*', 'v.name as vaccination_name', 'ims.name as imm_status', 'et.name as evidence_type_name')
                                    ->join('vaccination as v', 'vc.vaccination_id', '=', 'v.id')
                                    ->join('imm_status as ims', 'vc.immunization_status', '=', 'ims.id')
                                    ->join('evidence_type as et', 'vc.evidance_type', '=', 'et.id')
                                    ->where('vc.user_id', $request->id)
                                    ->get();

        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.vaccination_view')->with($data);
    }

    public function checks_clearacnces(Request $request)
    {
        
        $data['profileData']  = $this->nurseRepository->getOneUser(['id' => $request->id]);

        $user_id=$request->id;
        $data['ndis']               = NdisWorker::where('user_id', $user_id)->first();              
        $data['ww_child']           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
        $data['policy_check']       = PoliceCheckModel::where('user_id', $user_id)->first();
        $data['specialize']         = SpecializedClearance::where('user_id', $user_id)->get();
        $data['work_eligibility']   = DB::table('eligibility_to_work as ew')
                                ->select('ew.*','c.name as country_name', DB::raw("IFNULL(vs.sublcass_text, '') as sublcass_text"))
                                ->leftJoin('visa_subclas as vs', 'ew.visa_subclass', '=', 'vs.id')
                                ->leftJoin('country as c', 'ew.country_id', '=', 'c.id')
                                ->where('ew.user_id', $request->id)
                                ->first();
        // echo "<pre>";
        //  print_r($data['RefereData']);
        return view('admin.checks_clearacnces_view')->with($data);
    }

}