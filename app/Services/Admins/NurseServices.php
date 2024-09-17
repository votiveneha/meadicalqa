<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use App\Repository\Eloquent\NurseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\EducationModel;
use App\Models\ExperienceModel;
use App\Models\MandatoryTrainModel;
use App\Models\VaccinationFrontModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\ProfessionalAssocialtionModel;
use App\Models\InterviewModel;
use App\Models\PreferencesModel;
use App\Models\WorkPreferencesModel;
use App\Models\AdditionalInfo;
use App\Models\User;

class NurseServices
{
    protected $nurseRepository;
    public function __construct(NurseRepository $nurseRepository)
    {
        $this->nurseRepository = $nurseRepository;
    }
    public function changeStatusDelete($request)
    {
        try {
            $userData = $this->nurseRepository->getOneUser(['id'=>$request->id]);
            if ($request->status == 2) {
                $updateData['user_stage'] ='2';
                $run = $this->nurseRepository->updateData(['id'=>$userData->id], $updateData);
            } else {
                $run = $this->nurseRepository->deleteData(['id'=>$userData->id]);
            }
            if ($run == 1) {
                $message =__('message.delete',['parameter' =>'Profile ']);

                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                $body .= '<p>This mail to inform you that your account has been deleted.';
                $subject = 'Your Account has been Deleted!';

                $mailData = [
                    'subject' =>  $subject,
                    'email' =>$userData->email,
                    'body' => $body,
                ];
                $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                
                // if($sendMail){

                return response()->json(['status' => '2', 'message' =>$message]); 
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices.changeStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changeStatus($request)
    {
        try {
            $userData = $this->nurseRepository->getOneUser(['id'=>$request->id]);
            if ($request->status == 2) {
                $updateData['user_stage'] ='2';
                $run = $this->nurseRepository->updateData(['id'=>$userData->id], $updateData);
            } else {
                $run = $this->nurseRepository->deleteData(['id'=>$userData->id]);
            }
            if ($run == 1) {
                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                if($request->status == 2){
                    $body .= '<p>Your profile has been successfully validated!<br>You can now apply for all jobs and receive interview requests from healthcare facilities, nursing agencies, and individuals seeking nurse care at home.</p>';
                }else{
                    $body .= '<p>We regret to inform you that your account request has been rejected due to <b>'.$request->reasonData.'.</b><br><br> Please contact us for further information.
';
                }
                if($request->status == 2){
                        $subject = 'Your Account Request  has been  Approved!';
                    }else{
                        $subject = 'Your Account has been Rejected!';
                    }
                $mailData = [
                    'subject' =>  $subject,
                    'email' =>$userData->email,
                    'body' => $body,
                ];
                $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                Mail::to('deeksha.webwiders@gmail.com')->send(new \App\Mail\DemoMail($mailData));
                if ($sendMail) {
                    if($request->status == 2)
                {
                    $message =  __('message.approved');
                }else{
                    $message =__('message.reject');
                }
                return response()->json(['status' => '2', 'message' =>$message]);
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices.changeStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function changeStatusBlockUnblockold($request)
    {
        try {
            $userData = $this->nurseRepository->getOneUser(['id'=>$request->id]);
            $updateData['status'] = $request->status;
            $run = $this->nurseRepository->updateData(['id'=>$request->id], $updateData);
            if ($run == 1) {
                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                if($request->status == 2){
                    $body .= '<p>This is to inform you that your account has been blocked.';
                }else{
                    $body .= '<p>We are excited to inform you that your account has been unblocked by the admin. For more details, please check your account.';
                }
                if($request->status == 2){
                        $subject = 'Your Account has been  Blocked!';
                    }else{
                        $subject = 'Your Account has been Unblocked!';
                    }
                $mailData = [
                    'subject' =>  $subject,
                    'email' =>$userData->email,
                    'body' => $body,
                ];
                $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                
                if ($sendMail) {
                    if($request->status == 2)
                {
                    $message =  __('message.block');
                }else{
                    $message =__('message.unblock');
                }
                return response()->json(['status' => '2', 'message' =>$message]);
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices.changeStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function changeStatusBlockUnblock($request)
    {
        try {
            $userData = $this->nurseRepository->getOneUser(['id'=>$request->id]);
            $updateData['status'] = $request->status;
            $run = $this->nurseRepository->updateData(['id'=>$request->id], $updateData);
            if ($run == 1) {
                 $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;

                 if($request->status == 2){
                  
                 $body .= '<p>This is to inform you that your account has been blocked.';
                  $mailData = [
                    'subject' =>  'Block',
                    'email' =>$userData->email,
                    'body' => $body,
                  ];

                  $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));


                 }else{

                    $body .= '<p>We are excited to inform you that your account has been unblocked by the admin. For more details, please check your account..';
                    $mailData = [
                    'subject' =>  'Unblock',
                    'email' =>$userData->email,
                    'body' => '1',
                  ];

                  $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                 
                 }
   
                if ($sendMail) {
                    if($request->status == 2)
                {
                    $message =  __('message.block');
                }else{
                    $message =__('message.unblock');
                }
                return response()->json(['status' => '2', 'message' =>$message]);
                } else {
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices.changeStatus(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    
   public function addNursePost($data)
    {
        try {

            if($data['tab'] == 'tab1'){

                Session::put('nurseemail', $data['email']);
                $allData['name'] = $data['first_name'];
                $allData['lastname'] = $data['last_name'];
                $allData['phone'] = $data['contact'];
                $allData['country_code'] = $data['country_code_phone'];
                $allData['country_iso'] = $data['country_iso_phone'];
                $allData['email'] = $data['email'];
                $allData['gender'] = $data['gender'];
                $allData['date_of_birth'] = $data['dob'];
                $allData['personal_website'] = $data['per_website'];
                $allData['country'] = $data['country'];
                $allData['state'] = $data['state'];
                $allData['city'] = $data['city'];
                $allData['post_code'] = $data['zip_code'];
                $allData['home_address'] = $data['home_address'];
                $allData['emergency_conact_numeber'] = $data['emrg_contact'];
                $allData['emergergency_contact_email'] = $data['emrg_email'];
                $allData['profile_img'] = $data['profile_image'];
                $allData['emegency_country_code'] = $data['country_code_mobile'];
                $allData['emergency_country_iso'] = $data['country_iso_mobile'];
                $allData['nationality'] = $data['nationality'];
                $allData['emailVerified'] = '1';
                $allData['user_stage'] = '1';
                $run=$this->nurseRepository->create($allData);
                // dd($run);
                $param='Basic detail';
            
            }else if($data['tab'] == 'tab2'){
                
                $states=isset($data['states']) ? explode(',', $data['states']) : '';

                $allData['nurseType'] =  array_map('strval', $states);
                $allData['entry_level_nursing'] = isset($data['entry_level_nursing']) ? explode(',', $data['entry_level_nursing']) : '';
                $allData['registered_nurses'] = isset($data['registered_nurses']) ? explode(',', $data['registered_nurses']) : '';
                $allData['advanced_practioner'] = isset($data['advanced_practioner']) ? explode(',', $data['advanced_practioner']) : '';
                $allData['nurse_prac'] = isset($data['nurse_prac']) ? explode(',', $data['nurse_prac']) : '';
                $allData['specialties'] = isset($data['specialties']) ? explode(',', $data['specialties']) : '';
                $allData['adults'] = isset($data['adults']) ? explode(',', $data['adults']) : '';
                $allData['surgical_preoperative'] = isset($data['surgical_preoperative']) ? explode(',', $data['surgical_preoperative']) : '';
                $allData['operating_room'] =isset($data['operating_room']) ? explode(',', $data['operating_room']) : '';
                $allData['operating_room_scout'] = isset($data['operating_room_scout']) ? explode(',', $data['operating_room_scout']) : '';
                $allData['operating_room_scrub'] = isset($data['operating_room_scrub']) ? explode(',', $data['operating_room_scrub']) : '';
                $allData['maternity'] = isset($data['maternity']) ? explode(',', $data['maternity']) : '';
                $allData['surgical_obstrics_gynacology'] = isset($data['surgical_obstrics_gynacology']) ? explode(',', $data['surgical_obstrics_gynacology']) : '';
                $allData['paediatrics_neonatal'] = isset($data['paediatrics_neonatal']) ? explode(',', $data['paediatrics_neonatal']) : '';
                $allData['neonatal_care'] = isset($data['neonatal_care']) ? explode(',', $data['neonatal_care']) : '';
                $allData['paedia_surgical_preoperative'] = isset($data['paedia_surgical_preoperative']) ? explode(',', $data['paedia_surgical_preoperative']) : '';
                $allData['pad_op_room'] = isset($data['pad_op_room']) ? explode(',', $data['pad_op_room']) : '';
                $allData['pad_qr_scout'] = isset($data['pad_qr_scout']) ? explode(',', $data['pad_qr_scout']) : '';
                $allData['pad_qr_scrub'] = isset($data['pad_qr_scrub']) ? explode(',', $data['pad_qr_scrub']) : '';
                $allData['community'] = isset($data['community']) ? explode(',', $data['community']) : '';   
                $allData['current_employee_status'] = $data['current_employee_status'];   
                $allData['assistent_level'] = $data['assistent_level'];   
                $allData['bio'] = $data['bio'];   
                $allData['professional_info_status'] = $data['declare_information'];
                $email=Session::get('nurseemail');
                // dd($allData);
                $run=$this->nurseRepository->updateData(['email'=>$email], $allData);
                $param='Professional detail';

            // session()->forget('nurseemail');
            }else if($data['tab'] == 'tab3'){

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();

                if($data['acls_data'] != '[]'){
                    $acls_data=$data['acls_data'];
                    $acls_licence_num=$data['acls_license_number'];
                    $acls_licence_expiry=$data['acls_expiry'];

                    $acls_file=$data['acls_upload_certification'];
                    $acls_file_name='';


                    if($acls_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        // print_r($acls_file);die;
                        $acls_file_name=$acls_file->getClientOriginalName();
                        
                        $acls_file->move($destinationPath,$acls_file->getClientOriginalName());
                    }
                    $acls_array=array();
                    $acls_array=array("acls_data"=>$acls_data,"acls_licence_num"=>$acls_licence_num,"acls_licence_expiry"=>$acls_licence_expiry,"acls_file"=>$acls_file_name);
                }else{
                    $acls_array=NULL;
                }

            
                if($data['bls_data'] != '[]'){
                    $bls_data=$data['bls_data'];
                    //print_r($acls_data);
                    $bls_licence_num=$data['bls_license_number'];
                    $bls_licence_expiry=$data['bls_expiry'];

                    $bls_file=$data['bls_upload_certification'];

                    $bls_file_name='';

                    if($bls_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $bls_file_name=$bls_file->getClientOriginalName();
                        $bls_file->move($destinationPath,$bls_file->getClientOriginalName());
                    }
                    $bls_array=array();
                    $bls_array=array("bls_data"=>$bls_data,"bls_licence_num"=>$bls_licence_num,"bls_licence_expiry"=>$bls_licence_expiry,"bls_file"=>$bls_file_name);
                }else{
                    $bls_array=NULL;
                }

                if($data['cpr_data'] != '[]'){
                    $cpr_data=$data['cpr_data'];
                    //print_r($acls_data);
                    $cpr_licence_num=$data['cpr_license_number'];
                    $cpr_licence_expiry=$data['cpr_expiry'];

                    $cpr_file=$data['cpr_upload_certification'];

                    $cpr_file_name='';

                    if($cpr_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $cpr_file_name=$cpr_file->getClientOriginalName();
                        $cpr_file->move($destinationPath,$cpr_file->getClientOriginalName());
                    }

                    $cpr_array=array();
                    $cpr_array=array("cpr_data"=>$cpr_data,"cpr_licence_num"=>$cpr_licence_num,"cpr_licence_expiry"=>$cpr_licence_expiry,"cpr_file"=>$cpr_file_name);
                }else{
                    $cpr_array=NULL;
                }    


                if($data['nrp_data'] != '[]'){
                    $nrp_data=$data['nrp_data'];

                    //print_r($acls_data);
                    $nrp_licence_num=$data['nrp_license_number'];
                    $nrp_licence_expiry=$data['nrp_expiry'];

                    $nrp_file=$data['nrp_upload_certification'];
                    $nrp_file_name='';

                    if($nrp_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $nrp_file_name=$nrp_file->getClientOriginalName();
                        $nrp_file->move($destinationPath,$nrp_file->getClientOriginalName());
                    }   
                    $nrp_array=array();
                    $nrp_array=array("nrp_data"=>$nrp_data,"nrp_licence_num"=>$nrp_licence_num,"nrp_licence_expiry"=>$nrp_licence_expiry,"nrp_file"=>$nrp_file_name);
                }else{
                    $nrp_array=NULL;
                } 

                if($data['pals_data'] != '[]'){
                    $pals_data=$data['pals_data'];
                    //print_r($acls_data);
                    $pals_licence_num=$data['pals_license_number'];
                    $pals_licence_expiry=$data['pals_expiry'];

                    $pals_file=$data['pals_upload_certification'];

                    $pals_file_name='';

                    if($pals_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $pals_file_name=$pals_file->getClientOriginalName();
                        $pals_file->move($destinationPath,$pals_file->getClientOriginalName());
                    }
                
                    $pals_array=array();
                    $pals_array=array("pals_data"=>$pals_data,"pals_licence_num"=>$pals_licence_num,"pals_licence_expiry"=>$pals_licence_expiry,"pals_file"=>$pals_file_name);
                }else{
                    $pals_array=NULL;
                } 

                if($data['rn_data'] != '[]'){
                $rn_data=$data['rn_data'];
                $rn_licence_num=$data['rn_license_number'];
                $rn_licence_expiry=$data['rn_expiry'];
                $rn_file=$data['rn_upload_certification'];

                $rn_file_name='';

                if($rn_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $rn_file_name=$rn_file->getClientOriginalName();
                    $rn_file->move($destinationPath,$rn_file->getClientOriginalName());
                }
                
                $rn_array=array();
                $rn_array=array("rn_data"=>$rn_data,"rn_licence_num"=>$rn_licence_num,"rn_licence_expiry"=>$rn_licence_expiry,"rn_file"=>$rn_file_name);

                }else{
                    $rn_array=NULL;
                } 


            if($data['np_data'] != '[]'){
                $np_data=$data['np_data'];
                //print_r($acls_data);
                $np_licence_num=$data['np_license_number'];
                $np_licence_expiry=$data['np_expiry'];
                $np_file=$data['np_upload_certification'];
                $np_file_name='';

                if($np_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $np_file_name=$np_file->getClientOriginalName();
                    $np_file->move($destinationPath,$np_file->getClientOriginalName());
                }
                $np_array=array();
                $np_array=array("np_data"=>$np_data,"np_licence_num"=>$np_licence_num,"np_licence_expiry"=>$np_licence_expiry,"np_file"=>$np_file_name);
                }else{
                $np_array=NULL;
                }
                

                if($data['cn_data'] != '[]'){
                    $cna_data=$data['cn_data'];
                    //print_r($acls_data);
                    $cna_licence_num=$data['cn_license_number'];
                    $cna_licence_expiry=$data['cn_expiry'];

                    $cna_file=$data['cn_upload_certification'];

                    $cna_file_name=NULL;

                    if($cna_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $cna_file_name=$cna_file->getClientOriginalName();
                        $cna_file->move($destinationPath,$cna_file->getClientOriginalName());
                    }
                    
                    $cna_array=array();
                    $cna_array=array("cna_data"=>$cna_data,"cna_licence_num"=>$cna_licence_num,"cna_licence_expiry"=>$cna_licence_expiry,"cna_file"=>$cna_file_name);
                }else{
                    $cna_array=NULL;
                }

                if($data['lpn_data'] != '[]'){
                
                $lpn_data=$data['lpn_data'];
                $lpn_licence_num=$data['lpn_license_number'];
                $lpn_licence_expiry=$data['lpn_expiry'];
                $lpn_file=$data['lpn_upload_certification'];
                $lpn_file_name=NULL;

                if($lpn_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $lpn_file_name=$lpn_file->getClientOriginalName();
                    $lpn_file->move($destinationPath,$lpn_file->getClientOriginalName());
                }
                $lpn_array=array();
                $lpn_array=array("lpn_data"=>$lpn_data,"lpn_licence_num"=>$lpn_licence_num,"lpn_licence_expiry"=>$lpn_licence_expiry,"lpn_file"=>$lpn_file_name);
                }else{
                    $lpn_array=NULL;
                }

                if($data['crn_data'] != '[]'){
                $crna_data=$data['crn_data'];
                $crna_licence_num=$data['crn_license_number'];
                $crna_licence_expiry=$data['crn_expiry'];

                $crna_file=$data['crn_upload_certification'];

                $crna_file_name=NULL;

                if($crna_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $crna_file_name=$crna_file->getClientOriginalName();
                    $crna_file->move($destinationPath,$crna_file->getClientOriginalName());
                }
                $crna_array=array();
                $crna_array=array("crna_data"=>$crna_data,"crna_licence_num"=>$crna_licence_num,"crna_licence_expiry"=>$crna_licence_expiry,"crna_file"=>$crna_file_name);
                }else{
                $crna_array=NULL;
                }

                if($data['cnm_data'] != '[]'){

                    $cnm_data=$data['cnm_data'];
                    //print_r($acls_data);
                    $cnm_licence_num=$data['cnm_license_number'];
                    $cnm_licence_expiry=$data['cnm_expiry'];

                    $cnm_file=$data['cnm_upload_certification'];

                    $cnm_file_name=NULL;

                    if($cnm_file != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $cnm_file_name=$cnm_file->getClientOriginalName();
                        $cnm_file->move($destinationPath,$cnm_file->getClientOriginalName());
                    }
                
                    $cnm_array=array();
                    $cnm_array=array("cnm_data"=>$cnm_data,"cnm_licence_num"=>$cnm_licence_num,"cnm_licence_expiry"=>$cnm_licence_expiry,"cnm_file"=>$cnm_file_name);
                }else{
                    $cnm_array=NULL;
                }

                if($data['ons_data'] != '[]'){
                $ons_data=$data['ons_data'];
                //print_r($acls_data);
                $ons_licence_num=$data['ons_license_number'];
                $ons_licence_expiry=$data['ons_expiry'];

                $ons_file=$data['ons_upload_certification'];

                $ons_file_name=NULL;

                if($ons_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $ons_file_name=$ons_file->getClientOriginalName();
                    $ons_file->move($destinationPath,$ons_file->getClientOriginalName());
                }

                $ons_array=array();
                $ons_array=array("ons_data"=>$ons_data,"ons_licence_num"=>$ons_licence_num,"ons_licence_expiry"=>$ons_licence_expiry,"ons_file"=>$ons_file_name);
                }else{
                $ons_array=NULL;
                }

                if($data['msw_data'] != '[]'){

                    $msw_data=$data['msw_data'];
                    //print_r($acls_data);
                    $msw_licence_num=$data['msw_license_number'];
                    $msw_licence_expiry=$data['msw_expiry'];

                    $msw_file=$data['msw_upload_certification'];

                    $msw_file_name=''; 

                    if($msw_file  != 'undefined'){
                        $destinationPath=public_path().'/uploads';
                        $msw_file_name=$msw_file->getClientOriginalName();
                        $msw_file->move($destinationPath,$msw_file->getClientOriginalName());
                    }
                    $msw_array=array();
                    $msw_array=array("msw_data"=>$msw_data,"msw_licence_num"=>$msw_licence_num,"msw_licence_expiry"=>$msw_licence_expiry,"msw_file"=>$msw_file_name);
                }else{
                    $msw_array=NULL;
                }

                if($data['ain_data'] != '[]'){
                $ain_data=$data['ain_data'];
                //print_r($acls_data);
                $ain_licence_num=$data['ain_license_number'];
                $ain_licence_expiry=$data['ain_expiry'];

                $ain_file=$data['ain_upload_certification'];

                $ain_file_name='';

                if($ain_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $ain_file_name=$ain_file->getClientOriginalName();
                    $ain_file->move($destinationPath,$ain_file->getClientOriginalName());
                }
                $ain_array=array();
                $ain_array=array("ain_data"=>$ain_data,"ain_licence_num"=>$ain_licence_num,"ain_licence_expiry"=>$ain_licence_expiry,"ain_file"=>$ain_file_name);
                }else{
                    $ain_array=NULL;
                }

                if($data['rpn_data'] != '[]'){
                $rpn_data=$data['rpn_data'];
                $rpn_licence_num=$data['rpn_license_number'];
                $rpn_licence_expiry=$data['rpn_expiry'];
                $rpn_file=$data['rpn_upload_certification'];

                $rpn_file_name='';

                if($rpn_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $rpn_file_name=$rpn_file->getClientOriginalName();
                    $rpn_file->move($destinationPath,$rpn_file->getClientOriginalName());
                }
                $rpn_array=array();
                $rpn_array=array("rpn_data"=>$rpn_data,"rpn_licence_num"=>$rpn_licence_num,"rpn_licence_expiry"=>$rpn_licence_expiry,"rpn_file"=>$rpn_file_name);
                }else{
                    $rpn_array=NULL;
                }

                if($data['nlc_data'] != '[]'){
                $nl_data=$data['nlc_data'];
                //print_r($acls_data);
                $nl_licence_num=$data['nlc_license_number'];
                $nl_licence_expiry=$data['nlc_expiry'];

                $nl_file=$data['nlc_upload_certification'];

                $nl_file_name='';

                if($nl_file != 'undefined'){
                    $destinationPath=public_path().'/uploads';
                    $nl_file_name=$nl_file->getClientOriginalName();
                    $nl_file->move($destinationPath,$nl_file->getClientOriginalName());
                }
                $nl_array=array();
                $nl_array=array("nl_data"=>$nl_data,"nl_licence_num"=>$nl_licence_num,"nl_licence_expiry"=>$nl_licence_expiry,"nl_file"=>$nl_file_name);
                
                }else{
                $nl_array=NULL;
                }

                $user_id=$user_id->id;

                $CER=json_encode($data['professional_certification']);            
                $allData['institution'] = $data['institution'];
                $allData['most_relevant'] = $data['most_relevant'];
                $allData['graduate_start_date'] = $data['graduation_start_date'];
                $allData['graduate_end_date'] = $data['graduation_end_date'];
                $allData['professional_certifications'] = $CER;
                $allData['acls_data'] = json_encode($acls_array);
                $allData['bls_data'] = json_encode($bls_array);
                $allData['cpr_data'] = json_encode($cpr_array);
                $allData['nrp_data'] = json_encode($nrp_array);
                $allData['pals_data'] = json_encode($pals_array);
                $allData['rn_data'] = json_encode($rn_array);
                $allData['np_data'] = json_encode($np_array);
                $allData['cna_data'] = json_encode($cna_array);

                $allData['lpn_data']  = json_encode($lpn_array);
                $allData['crna_data'] = json_encode($crna_array);
                $allData['cnm_data']  = json_encode($cnm_array);
                $allData['ons_data']  = json_encode($ons_array);
                $allData['msw_data']  = json_encode($msw_array);
                $allData['ain_data']  = json_encode($ain_array);
                $allData['rpn_data']  = json_encode($rpn_array);
                $allData['nl_data']   = json_encode($nl_array);
                $allData['user_id']  =  $user_id  ;
                $allData['complete_status'] = 1;
                $allData['training_courses']  = isset($data['training_courses']) ? json_encode($data['training_courses']) : '';
                // $allData['training_workshops'] = isset($data['training_workshop']) ? json_encode($data['training_workshop']) : '';
                $run=EducationModel::create($allData);

                if($run){               
                    $allData['degree'] = $data['ndegree'];

                    User::where('id', $user_id)->update([
                        'degree' => $data['ndegree'],
                    ]);
                }
                
                $param='Education and Certification';

            }else if($data['tab'] == 'tab4'){

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['employer_name'] = $data['previous_employer_name'];
                $allData['position_held'] = json_encode($data['positions_held']);
                $allData['employeement_start_date'] = $data['start_date'];
                $allData['employeement_end_date'] = $data['end_date'];
                $allData['present_status'] = $data['end_date'];
                $allData['responsiblities'] = $data['job_responeblities'];
                $allData['achievements'] = $data['achievements'];
                $allData['skills_compantancies'] = json_encode($data['skills_compantancies']);

                $run=ExperienceModel::create($allData);

                if($run){               
                    $allData['assistent_level'] = $data['assistent_level'];

                    User::where('id', $user_id)->update([
                        'assistent_level' => $allData['assistent_level'],
                    ]);
                }

                $param='Experience and References';
           
            }else if($data['tab'] == 'tab5'){

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['start_date'] = $data['tra_start_date'];
                $allData['end_date'] = $data['tra_end_date'];
                $allData['institutions'] = $data['institution1'];
                $allData['continuing_education'] = $data['mand_continue_education'];

                $run=MandatoryTrainModel::create($allData);

                $param='Mandatory Training';
           
            }else if($data['tab'] == 'tab6'){

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['vaccination_records'] = json_encode($data['vaccination_record']);
                $allData['immunization_status'] = $data['immunization_status'];
                $allData['complete_status'] = 1;

                $run=VaccinationFrontModel::create($allData);

                $param='Vaccination Records';
           
            }else if($data['tab'] == 'tab7'){

                if($data['type'] == 'eligibility_work'){

                 $image_support_documentI=$data['image_support_documentI'];
                 $support_file_name='';

                 if($support_file_name != 'undefined'){
                    $destinationPath=public_path().'/nurse/assets/imgs/support_document/';
                    $support_file_name=$image_support_documentI->getClientOriginalName();
                    $image_support_documentI->move($destinationPath,$image_support_documentI->getClientOriginalName());
                  }
                
                $profile_image = $image_support_documentI->getClientOriginalName();
                // dd('test');
                $allData['support_document'] = '/nurse/assets/imgs/support_document/' . $profile_image;

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['residency'] = $data['residencyId'];
                $allData['visa_subclass_number'] = $data['visa_subclass_numberI'];
                $allData['passport_number'] = $data['passport_numberI'];
                $allData['passport_country_of_Issue'] = $data['passportcountryI'];
                $allData['expiry_date'] = $data['expiry_dataI'];
                $allData['visa_grant_number'] = $data['visa_grant_numberI'];

                $run=EligibilityToWorkModel::create($allData);

                $param='Eligibility To Work';
              }else if ($data['type'] == 'children_check') {

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['clearance_number'] = $data['clearance_numberI'];
                $allData['state'] = $data['clearancestateI'];
                $allData['expiry_date'] = $data['clearance_expiry_dataI'];
                $run=WorkingChildrenCheckModel::create($allData);

                $param='Children Check';
               }else if ($data['type'] == 'police_check') {

                $image_support_document_policeI=$data['image_support_document_policeI'];
                 $plice_file_name='';

                 if($image_support_document_policeI != 'undefined'){
                    $destinationPath=public_path().'/nurse/assets/imgs/police_check/';
                    $plice_file_name=$image_support_document_policeI->getClientOriginalName();
                    $image_support_document_policeI->move($destinationPath,$image_support_document_policeI->getClientOriginalName());
                  }
                
                $police_image = $image_support_document_policeI->getClientOriginalName();
                // dd('test');
                $allData['image'] = '/nurse/assets/imgs/police_check/' . $police_image;

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['date'] = $data['date_acquiredI'];
                $run=PoliceCheckModel::create($allData);

                $param='Police check';
               }
            }else if($data['tab'] == 'tab8'){
               
                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['des_profession_association'] = $data['des_profession_association'];
                $allData['membership_numbers'] = $data['membership_numbers'];
                $allData['membership_status'] = $data['membership_status'];
                $run=ProfessionalAssocialtionModel::create($allData);

                $param='Professional Memberships';

            }else if($data['tab'] == 'tab9'){
               
                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['interview_availablity'] = $data['interview_availablity'];
                $allData['reference_name'] = $data['reference_name'];
                $allData['reference_email'] = $data['reference_email'];
                $allData['contact_country_code'] = $data['reference_countryCode'];
                $allData['contact_country_iso'] = $data['reference_countryiso'];
                $allData['reference_contact'] = $data['reference_contactI'];
                $allData['reference_relationship'] = $data['reference_relationship'];
                $run=InterviewModel::create($allData);

                $param='Interview';

            }else if($data['tab'] == 'tab10'){
                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['preferred_work_schedule'] = $data['preferred_work_schedule'];
                $allData['country'] = $data['countryworkprefer'];
                $allData['state'] = $data['stateworkprefer'];
                $allData['specific_facilities'] = $data['specific_facilities'];
                $allData['work_environment'] = $data['work_environment'];
                $allData['shift_preferences'] = $data['shift_preferences'];
                $run=PreferencesModel::create($allData);
                $param='Personal Preferences';

            }else if($data['tab'] == 'tab11'){               
                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['desired_job_role'] = $data['des_job_role'];
                $allData['salary_expectations'] = $data['salary_expectation'];
                $allData['benefits_preferences'] = $data['benefit_prefer'];
                $run=WorkPreferencesModel::create($allData);
                $param='Job Search & Personal Preferences';

            }else if($data['tab'] == 'tab13'){               
                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
                $allData['user_id'] = $user_id->id;
                $allData['additional_info_language'] = $data['language_picker_select'];
                $allData['volunteer_experience'] = $data['volunteer_experience'];
                $allData['hobbies_interests'] = $data['hobbies_interests'];
                $run=AdditionalInfo::create($allData);
                $param='Additional Information';
            }
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => $param])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices/addNursePost(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
