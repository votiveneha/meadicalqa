<?php

namespace App\Http\Controllers\nurse;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\OtherVaccineModel;
use App\Models\EvidanceFileModel;
use App\Models\NdisWorker;
use App\Models\SpecializedClearance;


use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



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

use App\Models\InterviewModel;
use App\Models\PreferencesModel;
use App\Models\WorkPreferencesModel;
use App\Models\VaccinationFrontModel;
use App\Models\AdditionalInfo;
use App\Models\ProfessionalAssocialtionModel;
use App\Models\SubClassModel;
use App\Repository\Eloquent\SpecialityRepository;

class ProfessionalController extends Controller
{

    protected $specialityServices;
    protected $specialityRepository;
    protected $authServices;

    public function __construct(SpecialityServices $specialityServices, SpecialityRepository $specialityRepository, AuthServices $authServices)
    {
        $this->specialityServices = $specialityServices;
        $this->specialityRepository = $specialityRepository;
        $this->authServices = $authServices;
    }
    public function workClearances()
    {
        //This function is for load the view for work clearance
        $user_id=Auth::guard('nurse_middle')->user()->id;
        $visaSubclasses = SubClassModel::where('residence_id', 2) 
                                    ->orderBy('id') 
                                    ->get()
                                    ->groupBy('subclass_head'); 
        $visaholderSubclasses = SubClassModel::where('residence_id', 3) 
                                    ->orderBy('id') 
                                    ->get();

        $work_eligibility   = EligibilityToWorkModel::where('user_id', $user_id)->first();                     
        $ndis               = NdisWorker::where('user_id', $user_id)->first();              
        $ww_child           = WorkingChildrenCheckModel::where('user_id', $user_id)->get();
        $policy_check       = PoliceCheckModel::where('user_id', $user_id)->first();
        $specialize         = SpecializedClearance::where('user_id', $user_id)->get();
        

        return view('nurse.work_clearances',compact('visaSubclasses','visaholderSubclasses','work_eligibility','ndis','ww_child','policy_check','specialize'));
    }
    public function update_eligibility_to_work(Request $request)
    {
        //This function is for update the eligibility to work for nurse
        $lastRecord = EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord)
        {
            $professioninsert['original_file_name'] = $lastRecord['original_file_name'];
            $professioninsert['support_document']=$lastRecord['support_document'];

            $lastRecord->delete();
        }
        $professioninsert['user_id'] =  Auth::guard('nurse_middle')->user()->id;
        $professioninsert['residency'] = $request->residency;

        if($request->evidence_type!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type;
        }
        if($request->evidence_type1!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type1;
        }
        if($request->evidence_type2!='')
        {
            $professioninsert['evidence_type'] = $request->evidence_type2;
        }

        if($request->passport_number!='')
        {
            $professioninsert['passport_number'] = $request->passport_number;
        }
        if($request->passport_number1!='')
        {
            $professioninsert['passport_number'] = $request->passport_number1;
        }
        
        if($request->country_id!='')
        {
            $professioninsert['country_id']=$request->country_id;
        }
        if($request->country_id1!='')
        {
            $professioninsert['country_id']=$request->country_id1;
        }
        
        if($request->visa_subclass!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass;
        }
        if($request->visa_subclass1!='')
        {
            $professioninsert['visa_subclass']=$request->visa_subclass1;
            if($request->visa_subclass1==40)
            {
                $professioninsert['other_visa_type']=$request->other_visa_type??'';
            }
        }
        
        if($request->visa_grant_number!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number;
        }
        if($request->visa_grant_number1!='')
        {
            $professioninsert['visa_grant_number'] = $request->visa_grant_number1;
        }
        
        
        $professioninsert['status'] = '0';
        $professioninsert['created_at'] = Carbon::now('Asia/Kolkata');

        if ($request->hasFile('upload_evidence0')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence0->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence0->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence0')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        if ($request->hasFile('upload_evidence1')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence1->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence1->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence1')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        if ($request->hasFile('upload_evidence2')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->upload_evidence2->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->upload_evidence2->move($destinationPath, $filename);

            $professioninsert['original_file_name'] = $request->file('upload_evidence2')->getClientOriginalName();
            $professioninsert['support_document']=$filename;
        }
        //echo "<pre>";print_r($professioninsert);die();

        $run = EligibilityToWorkModel::insert($professioninsert);
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateNdis(Request $request)
    {
        //This function is for update the ndis record
       $ndis['state_id']= $request->ndis_state;
       $ndis['clearance_number']= $request->ndis_worker_clearance_number;
       $ndis['expiry_date']= $request->ndis_expiry_date;
       
       if ($request->hasFile('ndis_evidence')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->ndis_evidence->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->ndis_evidence->move($destinationPath, $filename);

            $ndis['original_file_name'] = $request->file('ndis_evidence')->getClientOriginalName();
            $ndis['evidence_file']=$filename;
        }
        
        $lastRecord = NdisWorker::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($ndis);
        }
        else
        {
            $ndis['created_at']= now();
            $ndis['user_id'] = Auth::guard('nurse_middle')->user()->id; 
            $run= NdisWorker::create($ndis);
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }
        echo json_encode($json);
    }    
    public function update_children_to_work(Request $request)
    {
        //This function is for add / update wwcc

/*
        $lastRecord = WorkingChildrenCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if ($lastRecord) {
            $lastRecord->delete();
        }
*/
        $user_id =  Auth::guard('nurse_middle')->user()->id;
        
        $wwcc_state         = $request->input('wwcc_state', []);
        $clearance_number   = $request->input('wwcc_clearance_number', []);
        $wwcc_expiry_date   = $request->input('wwcc_expiry_date', []);
        $wwcc_evidence      = $request->file('wwcc_evidence', []);
        $wwcc_id            = $request->input('wwcc_id', []);
        
        for ($i = 0; $i < count($wwcc_state); $i++) {
            if (isset($wwcc_id[$i])) 
            {
                $wwcc = WorkingChildrenCheckModel::find($wwcc_id[$i]);
                if ($wwcc) {
                    $wwcc->state_id         = $wwcc_state[$i];
                    $wwcc->clearance_number = $clearance_number[$i];
                    $wwcc->expiry_date      = $wwcc_expiry_date[$i];


                    if (isset($wwcc_evidence[$i]) && $wwcc_evidence[$i]->isValid()) {
                        $filename = 'evidence_file_' . time() . '.' . $wwcc_evidence[$i]->getClientOriginalExtension();
                        $destinationPath = public_path() . '/uploads/support_document';
                        $wwcc_evidence[$i]->move($destinationPath, $filename);
    
                        $wwcc->evidence_original_name = $wwcc_evidence[$i]->getClientOriginalName();
                        $wwcc->wwcc_evidence = $filename;
                    }
                    $run= $wwcc->save();
                }
            }
            else
            {
                
                $wwcc = new WorkingChildrenCheckModel();
                $wwcc->user_id          = $user_id;
                $wwcc->state_id         = $wwcc_state[$i];
                $wwcc->clearance_number = $clearance_number[$i];
                $wwcc->expiry_date      = $wwcc_expiry_date[$i];


                if (isset($wwcc_evidence[$i]) && $wwcc_evidence[$i]->isValid()) {
                    $filename = 'evidence_file_' . time() . '.' . $wwcc_evidence[$i]->getClientOriginalExtension();
                    $destinationPath = public_path() . '/uploads/support_document';
                    $wwcc_evidence[$i]->move($destinationPath, $filename);

                    $wwcc->evidence_original_name = $wwcc_evidence[$i]->getClientOriginalName();
                    $wwcc->wwcc_evidence = $filename;
                }
                $wwcc->status = 1;
                $wwcc->created_at = Carbon::now('Asia/Kolkata');
                $run =$wwcc->save();
                
            }
        }
        
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function removeWwcc(Request $request)
    {
        //This function is for ajax for remove wwcc from db
        $id = $request->id;

        $wwcc = WorkingChildrenCheckModel::find($id);

        if ($wwcc) {
            $filePath = 'uploads/support_document/' . $wwcc->wwcc_evidence;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $wwcc->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'wwcc not found']);
    }

    public function update_police_check_to_work(Request $request)
    {
        $policy['issuance_date'] = $request->issuance_date;
        
        if ($request->hasFile('clearance_document')) 
        {
            $filename = 'evidence_file_' . time() . '.' . $request->clearance_document->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/support_document';
            $request->clearance_document->move($destinationPath, $filename);

            $policy['original_file_name'] = $request->file('clearance_document')->getClientOriginalName();
            $policy['evidence_file']=$filename;
        }
        
        $lastRecord = PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord)
        {
            $run=$lastRecord->update($policy);
        }
        else
        {
            $policy['created_at']= Carbon::now('Asia/Kolkata');
            $policy['user_id'] = Auth::guard('nurse_middle')->user()->id; 
            $policy['status'] = '0';
            $run= PoliceCheckModel::create($policy);
        }

        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            // $json['url'] = url('nurse/my-profile#tab-myclearance-jobs');
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
    }
    public function updateSpecializedClearance(Request $request)
    {
        //This function is for update the specialized clearance

        $user_id =  Auth::guard('nurse_middle')->user()->id;
        
        $clearance_state        = $request->input('clearance_state', []);
        $clearance_type         = $request->input('clearance_type', []);
        $clearance_number       = $request->input('clearance_number', []);
        $clearance_expiry_date  = $request->input('clearance_expiry_date',[]);
        $clearance_evidence     = $request->file('clearance_evidence', []);
        $s_clearance_id         = $request->input('s_clearance_id', []);

        for ($i = 0; $i < count($clearance_state); $i++) {

            if (isset($s_clearance_id[$i])) 
            {
                $specialized = SpecializedClearance::find($s_clearance_id[$i]);
                if ($specialized) {
                    $specialized->clearance_state       = $clearance_state[$i];
                    $specialized->clearance_type        = $clearance_type[$i];
                    $specialized->clearance_number      = $clearance_number[$i];
                    $specialized->clearance_expiry_date = $clearance_expiry_date[$i];


                    if (isset($clearance_evidence[$i]) && $clearance_evidence[$i]->isValid()) {
                        $filename = 'evidence_file_' . time() . '.' . $clearance_evidence[$i]->getClientOriginalExtension();
                        $destinationPath = public_path() . '/uploads/support_document';
                        $clearance_evidence[$i]->move($destinationPath, $filename);
    
                        $specialized->clearance_original_name = $clearance_evidence[$i]->getClientOriginalName();
                        $specialized->clearance_evidence = $filename;
                    }
                    $run= $specialized->save();
                }
            }
            else
            {
                
                $specialized    = new SpecializedClearance();
                $specialized->user_id               = $user_id;
                $specialized->clearance_state       = $clearance_state[$i];
                $specialized->clearance_type        = $clearance_type[$i];
                $specialized->clearance_number      = $clearance_number[$i];
                $specialized->clearance_expiry_date = $clearance_expiry_date[$i];


                if (isset($clearance_evidence[$i]) && $clearance_evidence[$i]->isValid()) {
                    $filename = 'evidence_file_' . time() . '.' . $clearance_evidence[$i]->getClientOriginalExtension();
                    $destinationPath = public_path() . '/uploads/support_document';
                    $clearance_evidence[$i]->move($destinationPath, $filename);

                    $specialized->clearance_original_name = $clearance_evidence[$i]->getClientOriginalName();
                    $specialized->clearance_evidence = $filename;
                }
                
                $specialized->created_at = Carbon::now('Asia/Kolkata');
                $run =$specialized->save();
                
            }
        }
        if ($run) {
            $json['status'] = 1;
            $json['url'] = url('nurse/workClearances') . "?page=work_clearances";
            $json['message'] = 'You have Successfully submitted the details.';
        } else {
            $json['status'] = 0;
            $json['message'] = 'Please Try Again';
        }

        echo json_encode($json);
   }
    public function removeSpecialized(Request $request)
    {
        $id = $request->id;

        $specialed = SpecializedClearance::find($id);

        if ($specialed) {
            $filePath = 'uploads/support_document/' . $specialed->clearance_evidence;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $specialed->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Specialized Clearance not found']);
    }
    public function professionalMembership()
    {
        $data['organization_country'] = DB::table("professional_organization")->where("country_organiztions","0")->get();
        $data['awards_recognitions'] = DB::table("awards_recognitions")->where("sub_award_id","0")->get();
        return view('nurse.professional_membership')->with($data);
    }

    public function getCountryOrgnizations(Request $request)
    {
        
        $organization_id = $request->organization_id;
        $data['country_organiztions'] = DB::table("professional_organization")->where("country_organiztions",'like','%'.$organization_id.'%')->where("sub_organiztions","0")->get();
        $country_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        //print_r(json_encode($data));
        $data['country_name'] = $country_name->organization_country;
        $data['organization_id'] = $organization_id;
        return json_encode($data);
    }

    public function getCountrySubOrgnizations(Request $request)
    {
        
        $organization_id = $request->organization_id;
        $country_org_id = $request->country_org_id;
        $data['country_organiztions'] = DB::table("professional_organization")->where("country_organiztions",$country_org_id)->where("sub_organiztions",$organization_id)->get();
        $country_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        //print_r(json_encode($data));
        $data['country_name'] = $country_name->organization_country;
        $data['organization_id'] = $organization_id;
        return json_encode($data);
    }

    public function getMembershipData(Request $request)
    {
        $organization_id = $request->organization_id;
        $data['membership_type'] = DB::table("membership_type")->where("submember_id","0")->get();
        $organization_name = DB::table("professional_organization")->where("organization_id",$organization_id)->first();
        $data['organization_id'] = $organization_id;
        $data['organization_name'] = $organization_name->organization_country;
        return json_encode($data);
    }

    public function getsubMembershipData(Request $request)
    {
        $organization_id = $request->organization_id;
        $data['membership_type'] = DB::table("membership_type")->where("submember_id",$organization_id)->get();
        $organization_name = DB::table("membership_type")->where("membership_id",$organization_id)->first();
        $data['organization_id'] = $organization_id;
        $data['organization_name'] = $organization_name->membership_name;
        return json_encode($data);
    }

    public function getawardsRecognitions(Request $request)
    {
        $award_id = $request->award_id;
        $data['award'] = DB::table("awards_recognitions")->where("sub_award_id",$award_id)->get();
        $organization_name = DB::table("awards_recognitions")->where("award_id",$award_id)->first();
        $data['organization_id'] = $award_id;
        $data['award_name'] = $organization_name->award_name;
        return json_encode($data);
    }

    public function interview()
    {
        //This function is for interview prefrence
        return view('nurse.interview_references');
    }
    public function personalPreferences()
    {
        //This function is for personal preferences
        return view('nurse.personal_preferences');
    }
    public function jobSearch()
    {
        //This function is for job search preference
        return view('nurse.job_search');
    }
    public function additionalInfo()
    {
        //This function is for additional information
        return view('nurse.additional_info');
    }
}
