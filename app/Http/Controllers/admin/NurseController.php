<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Nurseform2Request;
use App\Http\Requests\Nurseform1Request;
use App\Http\Requests\Nurseform3Request;


class NurseController extends Controller
{
    protected $nurseRepository;
    protected $nurseServices;
    protected $verificationRepository;

    public function __construct(NurseRepository $nurseRepository,NurseServices $nurseServices , VerificationRepository $verificationRepository){
        $this->nurseRepository = $nurseRepository;
        $this->nurseServices = $nurseServices;
        $this->verificationRepository = $verificationRepository;
    }
    public function incommingNurseList()
    {
        try {
            $incomingNurseUsers  = $this->nurseRepository->getIncomingNurseList();
            // dd($incomingNurseUsers);
            return view('admin.incoming-nurse-list',compact('incomingNurseUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function inProgressprofileNurseList()
    {
        try {
            $inprogressprofileUsers  = $this->nurseRepository->getInProgressprofileNurseList();
            // dd($incomingNurseUsers);
            return view('admin.inprogress-profile-nurse-list',compact('inprogressprofileUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function send_remainder(Request $request){
        try {
            $body = 'Dear ' . $request->name;
            $body .= '<p>We hope this message finds you well!</p>';
            $body .= '<p>We noticed that your profile is not yet complete. Completing your profile will allow you to access a wide range of job opportunities from healthcare facilities, agencies, and individuals seeking nursing care at home.</p>';
            $body .= '<p>To unlock these opportunities, please take a few minutes to finish your profile. Here’s what you need to do:</p>';
            $body .= '<ul><li style="list-style-type:none;margin-left: -23px;">- Log in to your <a href="'.url('/nurse').'/login">account</li>';
            $body .= '<li style="list-style-type:none">- Complete all required sections, including your experience, specialties, and certifications.</li>';
            $body .= '<li style="list-style-type:none">- Submit your profile for approval.</li></ul>';
            $body .= "<p>Once approved, you'll be able to:</p>";
            $body .= '<ul><li style="list-style-type:none">- Apply for various shifts and permanent positions.</li>';
            $body .= '<li style="list-style-type:none">- Make your profile visible to potential employers.</li>';
            $body .= '<li style="list-style-type:none">- Receive interview requests and offers tailored to your preferences.</li></ul>';
            $body .= "<p>Don't miss out on the chance to advance your career and find the perfect nursing job for you!</p>";
            $body .= '<p>If you have any questions or need assistance, feel free to contact us at <a href="'.url('/contact').'">Contact</a></p>';
            $body .= '<p>Thank you for being a part of our community, and we look forward to seeing your completed profile soon!</p>';
            

            $subject = 'Complete Your Profile to Access Exciting Job Opportunities!';

            $mailData = [
                'subject' =>  $subject,
                'email' =>$request->email,
                'body' => $body,
            ];
            $sendMail = Mail::to($request->email)->send(new \App\Mail\DemoMail($mailData));

            if($sendMail){
                return response()->json(['status' => '2', 'message' =>'Remainder has been sent successfully']);
            }
        } catch (\Exception $e) {
            log::error('Error in NurseController/send_remainder :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
        

    }
    
    public function completeprofileNurseList()
    {
        try {
            $completeprofileUsers  = $this->nurseRepository->getcompleteprofileNurseList();
            // dd($incomingNurseUsers);
            return view('admin.complete-profile-nurse-list',compact('completeprofileUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/incommingNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function customerList()
    {
        try {
            $Users  = $this->nurseRepository->getCustomerList();
            return view('admin.customer-list',compact('Users'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/customerList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function activeNurseList()
    {
        try {
            $activeNurseUsers  = $this->nurseRepository->getActiveNurseList();
            return view('admin.active-nurse-list',compact('activeNurseUsers'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/activeNurseList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function viewProfile(Request $request)
    {
        try {
            $professionVerificationData = $this->verificationRepository->get(['user_id' => $request->id]);
            $profileData  = $this->nurseRepository->getOneUser(['id'=>$request->id]);
            $educationData  = $this->nurseRepository->getEducationCerdetails(['user_id'=>$request->id]);
            $experienceData  = $this->nurseRepository->getExperiencedetails(['user_id'=>$request->id]);
            $mandatorytrainingData  = $this->nurseRepository->getMandatorytrainingdetails(['user_id'=>$request->id]);
            $interviewrefData  = $this->nurseRepository->getInterviewrefdetails(['user_id'=>$request->id]);
            $personalprefData  = $this->nurseRepository->getPersonalprefdetails(['user_id'=>$request->id]);
            $findworkData  = $this->nurseRepository->getfindworkdetails(['user_id'=>$request->id]);
            $vaccinationData  = $this->nurseRepository->getvaccinationdetails(['user_id'=>$request->id]);
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => $request->id]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => $request->id]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => $request->id]);
            return view('admin.profile-view',compact('profileData','experienceData','policeCheckVerificationData','eligibilityToWorkData','workingChildrenCheckData','educationData','mandatorytrainingData',
            'interviewrefData','personalprefData','findworkData','vaccinationData'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/viewProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNurse(Request $request)
    {
        try {
            $professionVerificationData = $this->verificationRepository->get(['user_id' => 58]);
            $profileData  = $this->nurseRepository->getOneUser(['id'=> 58]);
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => 58]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => 58]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => 58]);
            return view('admin.add-nurse',compact('profileData','professionVerificationData','policeCheckVerificationData','eligibilityToWorkData','workingChildrenCheckData'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/viewProfile :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm1(Nurseform1Request $request)
    {        
        if ($request->hasFile('profile_image')) {
            $profile_image = time() . '.' . $request->profile_image->extension();

            if ($request->profile_image->move(public_path('/nurse/assets/imgs/'), $profile_image)) {
               $request->profile_image = '/nurse/assets/imgs/' . $profile_image;
            }
        }
        try {
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm2(Nurseform2Request $request)
    {       
        try {
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
      public function addNursePostForm3(Nurseform3Request $request)
    {      
        try {
            if($request->acls_data){
                $acls_data = $request->acls_data;
                //print_r($acls_data);
                $acls_licence_num = $request->acls_license_number;
                $acls_licence_expiry = $request->acls_expiry;

                $acls_file = $request->file('acls_upload_certification');

                if($acls_file){
                    $destinationPath = public_path().'/uploads';
                    $acls_file_name = $acls_file->getClientOriginalName();
                    $acls_file->move($destinationPath,$acls_file->getClientOriginalName());
                }
              

                $acls_array = array();
                $acls_array = array("acls_data"=>$acls_data,"acls_licence_num"=>$acls_licence_num,"acls_licence_expiry"=>$acls_licence_expiry,"acls_file"=>$acls_file_name);
            }else{
                $acls_array = "";
            }

            $request->acls_data = $acls_array;


//             if($request->bls_data){
//                 $bls_data = json_encode($request->bls_data);
//                 //print_r($acls_data);
//                 $bls_licence_num = $request->bls_license_number;
//                 $bls_licence_expiry = $request->bls_expiry;

//                 $bls_file = $request->file('bls_upload_certification');

//                 if($bls_file){
//                     $destinationPath = public_path().'/uploads';
//                     $bls_file_name = $bls_file->getClientOriginalName();
//                     $bls_file->move($destinationPath,$bls_file->getClientOriginalName());
//                 }else{
//                     $bls_data_one = json_decode($getedudata->bls_data);

//                     if($bls_data_one != NULL){
//                        $bls_file_name = $bls_data_one->bls_file;
//                     }else{
//                         $bls_file_name = "";
//                     }
                    
                    
//                 }
                

//                 $bls_array = array();
//                 $bls_array = array("bls_data"=>$bls_data,"bls_licence_num"=>$bls_licence_num,"bls_licence_expiry"=>$bls_licence_expiry,"bls_file"=>$bls_file_name);
//             }else{
//                 $bls_array = "";
//             }

//             if($request->cpr_data){
//                 $cpr_data = json_encode($request->cpr_data);
//                 //print_r($acls_data);
//                 $cpr_licence_num = $request->cpr_license_number;
//                 $cpr_licence_expiry = $request->cpr_expiry;

//                 $cpr_file = $request->file('cpr_upload_certification');

//                 if($cpr_file){
//                     $destinationPath = public_path().'/uploads';
//                     $cpr_file_name = $cpr_file->getClientOriginalName();
//                     $cpr_file->move($destinationPath,$cpr_file->getClientOriginalName());
//                 }else{
//                     $cpr_data_one = json_decode($getedudata->cpr_data);

//                     if($cpr_data_one != NULL){
//                         $cpr_file_name = $cpr_data_one->cpr_file;
//                     }else{
//                         $cpr_file_name = "";
//                     }
                    
                    
//                 }
                

//                 $cpr_array = array();
//                 $cpr_array = array("cpr_data"=>$cpr_data,"cpr_licence_num"=>$cpr_licence_num,"cpr_licence_expiry"=>$cpr_licence_expiry,"cpr_file"=>$cpr_file_name);
//             }else{
//                 $cpr_array = "";
//             }    


//             if($request->nrp_data){
//                 $nrp_data = json_encode($request->nrp_data);

//                 //print_r($acls_data);
//                 $nrp_licence_num = $request->nrp_license_number;
//                 $nrp_licence_expiry = $request->nrp_expiry;

//                 $nrp_file = $request->file('nrp_upload_certification');

//                 if($nrp_file){
//                     $destinationPath = public_path().'/uploads';
//                     $nrp_file_name = $nrp_file->getClientOriginalName();
//                     $nrp_file->move($destinationPath,$nrp_file->getClientOriginalName());
//                 }else{
//                     $nrp_data_one = json_decode($getedudata->nrp_data);
                    
//                     if($nrp_data_one != NULL){
//                         $nrp_file_name = $nrp_data_one->nrp_file;
//                     }else{
//                         $nrp_file_name = "";
//                     }
                    
//                 }
                

//                 $nrp_array = array();
//                 $nrp_array = array("nrp_data"=>$nrp_data,"nrp_licence_num"=>$nrp_licence_num,"nrp_licence_expiry"=>$nrp_licence_expiry,"nrp_file"=>$nrp_file_name);
//             }else{
//                 $nrp_array = "";
//             } 

//             if($request->pals_data){
//                 $pals_data = json_encode($request->pals_data);
//                 //print_r($acls_data);
//                 $pals_licence_num = $request->pals_license_number;
//                 $pals_licence_expiry = $request->pals_expiry;

//                 $pals_file = $request->file('pals_upload_certification');

//                 if($pals_file){
//                     $destinationPath = public_path().'/uploads';
//                     $pals_file_name = $pals_file->getClientOriginalName();
//                     $pals_file->move($destinationPath,$pals_file->getClientOriginalName());
//                 }else{
//                     $pals_data_one = json_decode($getedudata->pals_data);
                    
                    
//                     if($pals_data_one != NULL){
//                         $pals_file_name = $pals_data_one->pals_file;
//                     }else{
//                         $pals_file_name = "";
//                     }
//                 }
                

//                 $pals_array = array();
//                 $pals_array = array("pals_data"=>$pals_data,"pals_licence_num"=>$pals_licence_num,"pals_licence_expiry"=>$pals_licence_expiry,"pals_file"=>$pals_file_name);
//             }else{
//                 $pals_array = "";
//             } 

//             if($request->rn_data){
//             $rn_data = json_encode($request->rn_data);
//             //print_r($acls_data);
//             $rn_licence_num = $request->rn_license_number;
//             $rn_licence_expiry = $request->rn_expiry;

//             $rn_file = $request->file('rn_upload_certification');

//             if($rn_file){
//                 $destinationPath = public_path().'/uploads';
//                 $rn_file_name = $rn_file->getClientOriginalName();
//                 $rn_file->move($destinationPath,$rn_file->getClientOriginalName());
//             }else{
//                 $rn_data_one = json_decode($getedudata->rn_data);

//                 if($rn_data_one != NULL){
//                     $rn_file_name = $rn_data_one->rn_file;
//                 }else{
//                     $rn_file_name = "";
//                 }
                
                
//             }
            

//             $rn_array = array();
//             $rn_array = array("rn_data"=>$rn_data,"rn_licence_num"=>$rn_licence_num,"rn_licence_expiry"=>$rn_licence_expiry,"rn_file"=>$rn_file_name);

//         }else{
//                 $rn_array = "";
//             } 
//         if($request->np_data){
//             $np_data = json_encode($request->np_data);
//             //print_r($acls_data);
//             $np_licence_num = $request->np_license_number;
//             $np_licence_expiry = $request->np_expiry;

//             $np_file = $request->file('np_upload_certification');

//             if($np_file){
//                 $destinationPath = public_path().'/uploads';
//                 $np_file_name = $np_file->getClientOriginalName();
//                 $np_file->move($destinationPath,$np_file->getClientOriginalName());
//             }else{
//                 $np_data_one = json_decode($getedudata->np_data);

//                 if($np_data_one != NULL){
//                     $np_file_name = $np_data_one->np_file;
//                 }else{
//                     $np_file_name = "";
//                 }
                
                
//             }
            

//             $np_array = array();
//             $np_array = array("np_data"=>$np_data,"np_licence_num"=>$np_licence_num,"np_licence_expiry"=>$np_licence_expiry,"np_file"=>$np_file_name);
//         }else{
//                 $np_array = "";
//             }
//         if($request->cna_data){
//             $cna_data = json_encode($request->cna_data);
//             //print_r($acls_data);
//             $cna_licence_num = $request->cna_license_number;
//             $cna_licence_expiry = $request->cna_expiry;

//             $cna_file = $request->file('cna_upload_certification');

//             if($cna_file){
//                 $destinationPath = public_path().'/uploads';
//                 $cna_file_name = $cna_file->getClientOriginalName();
//                 $cna_file->move($destinationPath,$cna_file->getClientOriginalName());
//             }else{
//                 $cna_data_one = json_decode($getedudata->cna_data);

//                 if($cna_data_one != NULL){
//                     $cna_file_name = $cna_data_one->cna_file;
//                 }else{
//                     $cna_file_name = "";
//                 }
                
                
//             }
            

//             $cna_array = array();
//             $cna_array = array("cna_data"=>$cna_data,"cna_licence_num"=>$cna_licence_num,"cna_licence_expiry"=>$cna_licence_expiry,"cna_file"=>$cna_file_name);
//           }else{
//                 $cna_array = "";
//             }
//           if($request->lpn_data){
//             $lpn_data = json_encode($request->lpn_data);
//             //print_r($acls_data);
//             $lpn_licence_num = $request->lpn_license_number;
//             $lpn_licence_expiry = $request->lpn_expiry;

//             $lpn_file = $request->file('lpn_upload_certification');

//             if($lpn_file){
//                 $destinationPath = public_path().'/uploads';
//                 $lpn_file_name = $lpn_file->getClientOriginalName();
//                 $lpn_file->move($destinationPath,$lpn_file->getClientOriginalName());
//             }else{
//                 $lpn_data_one = json_decode($getedudata->lpn_data);

//                 if($lpn_data_one != NULL){
//                     $lpn_file_name = $lpn_data_one->lpn_file;
//                 }else{
//                     $lpn_file_name = "";
//                 }
                
                
//             }
            

//             $lpn_array = array();
//             $lpn_array = array("lpn_data"=>$lpn_data,"lpn_licence_num"=>$lpn_licence_num,"lpn_licence_expiry"=>$lpn_licence_expiry,"lpn_file"=>$lpn_file_name);
//         }else{
//                 $lpn_array = "";
//             }

//             if($request->crna_data){
//             $crna_data = json_encode($request->crna_data);
//             //print_r($acls_data);
//             $crna_licence_num = $request->crna_license_number;
//             $crna_licence_expiry = $request->crna_expiry;

//             $crna_file = $request->file('crna_upload_certification');

//             if($crna_file){
//                 $destinationPath = public_path().'/uploads';
//                 $crna_file_name = $crna_file->getClientOriginalName();
//                 $crna_file->move($destinationPath,$crna_file->getClientOriginalName());
//             }else{
//                 $crna_data_one = json_decode($getedudata->crna_data);

//                 if($crna_data_one != NULL){
//                     $crna_file_name = $crna_data_one->crna_file;
//                 }else{
//                     $crna_file_name = "";
//                 }
                
                
//             }
            

//             $crna_array = array();
//             $crna_array = array("crna_data"=>$crna_data,"crna_licence_num"=>$crna_licence_num,"crna_licence_expiry"=>$crna_licence_expiry,"crna_file"=>$crna_file_name);
//         }else{
//                 $crna_array = "";
//             }

//         if($request->cnm_data){

//             $cnm_data = json_encode($request->cnm_data);
//             //print_r($acls_data);
//             $cnm_licence_num = $request->cnm_license_number;
//             $cnm_licence_expiry = $request->cnm_expiry;

//             $cnm_file = $request->file('cnm_upload_certification');

//             if($cnm_file){
//                 $destinationPath = public_path().'/uploads';
//                 $cnm_file_name = $cnm_file->getClientOriginalName();
//                 $cnm_file->move($destinationPath,$cnm_file->getClientOriginalName());
//             }else{
//                 $cnm_data_one = json_decode($getedudata->cnm_data);

//                 if($cnm_data_one != NULL){
//                     $cnm_file_name = $cnm_data_one->cnm_file;
//                 }else{
//                     $cnm_file_name = "";
//                 }
                
                
//             }
            

//             $cnm_array = array();
//             $cnm_array = array("cnm_data"=>$cnm_data,"cnm_licence_num"=>$cnm_licence_num,"cnm_licence_expiry"=>$cnm_licence_expiry,"cnm_file"=>$cnm_file_name);
//       }else{
//                 $cnm_array = "";
//             }

//       if($request->ons_data){
//             $ons_data = json_encode($request->ons_data);
//             //print_r($acls_data);
//             $ons_licence_num = $request->ons_license_number;
//             $ons_licence_expiry = $request->ons_expiry;

//             $ons_file = $request->file('ons_upload_certification');

//             if($ons_file){
//                 $destinationPath = public_path().'/uploads';
//                 $ons_file_name = $ons_file->getClientOriginalName();
//                 $ons_file->move($destinationPath,$ons_file->getClientOriginalName());
//             }else{
//                 $ons_data_one = json_decode($getedudata->ons_data);

//                 if($ons_data_one != NULL){
//                     $ons_file_name = $ons_data_one->ons_file;
//                 }else{
//                     $ons_file_name = "";
//                 }
                
                
//             }
            

//             $ons_array = array();
//             $ons_array = array("ons_data"=>$ons_data,"ons_licence_num"=>$ons_licence_num,"ons_licence_expiry"=>$ons_licence_expiry,"ons_file"=>$ons_file_name);
//         }else{
//                 $ons_array = "";
//             }

//         if($request->msw_data){

//             $msw_data = json_encode($request->msw_data);
//             //print_r($acls_data);
//             $msw_licence_num = $request->msw_license_number;
//             $msw_licence_expiry = $request->msw_expiry;

//             $msw_file = $request->file('msw_upload_certification');

//             if($msw_file){
//                 $destinationPath = public_path().'/uploads';
//                 $msw_file_name = $msw_file->getClientOriginalName();
//                 $msw_file->move($destinationPath,$msw_file->getClientOriginalName());
//             }else{
//                 $msw_data_one = json_decode($getedudata->msw_data);

//                 if($msw_data_one != NULL){
//                     $msw_file_name = $msw_data_one->msw_file;
//                 }else{
//                     $msw_file_name = "";
//                 }
                
                
//             }
            

//             $msw_array = array();
//             $msw_array = array("msw_data"=>$msw_data,"msw_licence_num"=>$msw_licence_num,"msw_licence_expiry"=>$msw_licence_expiry,"msw_file"=>$msw_file_name);
//         }else{
//                 $msw_array = "";
//             }
//         if($request->ain_data){
//             $ain_data = json_encode($request->ain_data);
//             //print_r($acls_data);
//             $ain_licence_num = $request->ain_license_number;
//             $ain_licence_expiry = $request->ain_expiry;

//             $ain_file = $request->file('ain_upload_certification');

//             if($ain_file){
//                 $destinationPath = public_path().'/uploads';
//                 $ain_file_name = $ain_file->getClientOriginalName();
//                 $ain_file->move($destinationPath,$ain_file->getClientOriginalName());
//             }else{
//                 $ain_data_one = json_decode($getedudata->ain_data);

//                 if($ain_data_one != NULL){
//                     $ain_file_name = $ain_data_one->ain_file;
//                 }else{
//                     $ain_file_name = "";
//                 }
                
                
//             }
            

//             $ain_array = array();
//             $ain_array = array("ain_data"=>$ain_data,"ain_licence_num"=>$ain_licence_num,"ain_licence_expiry"=>$ain_licence_expiry,"ain_file"=>$ain_file_name);
//         }else{
//                 $ain_array = "";
//             }
//         if($request->rpn_data){
//             $rpn_data = json_encode($request->rpn_data);
//             //print_r($acls_data);
//             $rpn_licence_num = $request->rpn_license_number;
//             $rpn_licence_expiry = $request->rpn_expiry;

//             $rpn_file = $request->file('rpn_upload_certification');

//             if($rpn_file){
//                 $destinationPath = public_path().'/uploads';
//                 $rpn_file_name = $rpn_file->getClientOriginalName();
//                 $rpn_file->move($destinationPath,$rpn_file->getClientOriginalName());
//             }else{
//                 $rpn_data_one = json_decode($getedudata->rpn_data);

//                 if($rpn_data_one != NULL){
//                     $rpn_file_name = $rpn_data_one->rpn_file;
//                 }else{
//                     $rpn_file_name = "";
//                 }
                
                
//             }
            

//             $rpn_array = array();
//             $rpn_array = array("rpn_data"=>$rpn_data,"rpn_licence_num"=>$rpn_licence_num,"rpn_licence_expiry"=>$rpn_licence_expiry,"rpn_file"=>$rpn_file_name);
//         }else{
//                 $rpn_array = "";
//             }

//         if($request->nl_data){
//             $nl_data = json_encode($request->nl_data);
//             //print_r($acls_data);
//             $nl_licence_num = $request->nl_license_number;
//             $nl_licence_expiry = $request->nl_expiry;

//             $nl_file = $request->file('nl_upload_certification');

//             if($nl_file){
//                 $destinationPath = public_path().'/uploads';
//                 $nl_file_name = $nl_file->getClientOriginalName();
//                 $nl_file->move($destinationPath,$nl_file->getClientOriginalName());
//             }else{
//                 $nl_data_one = json_decode($getedudata->nl_data);

//                 if($nl_data_one != NULL){
//                     $nl_file_name = $nl_data_one->nl_file;
//                 }else{
//                     $nl_file_name = "";
//                 }
                
                
//             }
            

//             $nl_array = array();
//             $nl_array = array("nl_data"=>$nl_data,"nl_licence_num"=>$nl_licence_num,"nl_licence_expiry"=>$nl_licence_expiry,"nl_file"=>$nl_file_name);
            
// }else{
//                 $nl_array = "";
//             }
            
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
  
    public function changeStatus(Request $request)
    {
        try {
           return $this->nurseServices->changeStatus($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatus :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changeStatusDelete(Request $request)
    {
        try {
           return $this->nurseServices->changeStatusDelete($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatusDelete :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changeStatusBlockUnblock(Request $request)
    {
        try {
           return $this->nurseServices->changeStatusBlockUnblock($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/changeStatusBlockUnblock :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
   

}
