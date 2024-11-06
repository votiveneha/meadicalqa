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
use App\Models\AddReferee;
use Illuminate\Support\Facades\Hash;
use Helpers;
use DB;

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

                if ($data['profile_image']) {
                    $profile_img = $data['profile_image'];
                    $destinationPath=public_path().'/nurse/assets/imgs/';
                    $profile_img_name=$profile_img->getClientOriginalName();                    
                    $profile_img->move($destinationPath,$profile_img->getClientOriginalName());  
                    $profilename = 'nurse/assets/imgs/' . $profile_img_name;  
                        
                }
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
                $allData['profile_img'] = $profilename;
                $allData['emegency_country_code'] = $data['country_code_mobile'];
                $allData['emergency_country_iso'] = $data['country_iso_mobile'];
                $allData['nationality'] = $data['nationality'];
                $allData['emailVerified'] = '1';
                $allData['user_stage'] = '1';
                $allData['password'] =  Hash::make($data['passwordI']);
                $allData['ps'] =  $data['passwordI'];
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
                $allData['user_stage'] = '5';
                $allData['professional_info_status'] = $data['declare_information'];
                $email=Session::get('nurseemail');
                // dd($allData);
                $run=$this->nurseRepository->updateData(['email'=>$email], $allData);
                $param='Professional detail';

            // session()->forget('nurseemail');
            }else if($data['tab'] == 'tab3'){

                $email=Session::get('nurseemail');
                $user_id=User::where('email',$email)->first();
               

                
                $bls_data = $data['bls_data'];
                if($bls_data){
                    $bls_count = count($bls_data);
                }else{
                    $bls_count = 0;
                }
                $bls_license_number = $data['bls_license_number'];
                $bls_expiry =$data['bls_expiry'];
                $bls_upload_certification =$data['bls_upload_certification'];

                $bls_data_array = array();

                for($i=0;$i<$bls_count;$i++){
                    if(!empty($bls_upload_certification[$i])){
                        $name1=$bls_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $bls_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->bls_data);
                        $name = $certificate_data[$i]->bls_upload_certification;
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->bls_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $bls_data_array[] = array("bls_certification_id"=>$bls_data[$i],"bls_license_number"=>$bls_license_number[$i],"bls_expiry"=>$bls_expiry[$i],"bls_upload_certification"=>$name);
                }

                if(!empty($bls_data_array)){
                    $bls_data_json = json_encode($bls_data_array);
                }else{
                    $bls_data_json = '';
                }

                

                $acls_data = $data['acls_data'];
                if($acls_data){
                    $acls_count = count($acls_data);
                }else{
                    $acls_count = 0;
                }
                $aclsnamearr = $data['aclsnamearr'];
                $acls_license_number =$data['acls_license_number'];
                $acls_expiry = $data['acls_expiry'];
                $acls_upload_certification = $data['acls_upload_certification'];

                $acls_data_array = array();

                for($i=0;$i<$acls_count;$i++){
                    if(!empty($acls_upload_certification[$i])){
                        $name1=$acls_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $acls_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->acls_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->acls_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $acls_data_array[] = array("acls_certification_id"=>$aclsnamearr[$i],"acls_license_number"=>$acls_license_number[$i],"acls_expiry"=>$acls_expiry[$i],"acls_upload_certification"=>$name);
                }

                if(!empty($acls_data_array)){
                    $acls_data_json = json_encode($acls_data_array);
                }else{
                    $acls_data_json = '';
                }

                $cpr_data = $data['cpr_data'];
                if($cpr_data){
                    $cpr_count = count($cpr_data);
                }else{
                    $cpr_count = 0;
                }
                $cprnamearr = $data['cprnamearr'];

                $cpr_license_number = $data['cpr_license_number'];
                $cpr_expiry = $data['cpr_expiry'];
                $cpr_upload_certification = $data['cpr_upload_certification'];

                $cpr_data_array = array();

                for($i=0;$i<$cpr_count;$i++){
                    if(!empty($cpr_upload_certification[$i])){
                        $name1=$cpr_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $cpr_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->cpr_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->cpr_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $cpr_data_array[] = array("cpr_certification_id"=>$cprnamearr[$i],"cpr_license_number"=>$cpr_license_number[$i],"cpr_expiry"=>$cpr_expiry[$i],"cpr_upload_certification"=>$name);
                }

                if(!empty($cpr_data_array)){
                    $cpr_data_json = json_encode($cpr_data_array);
                    
                }else{
                    $cpr_data_json = '';
                }

                $nrp_data = $data['nrp_data'];
                if($nrp_data){
                    $nrp_count = count($nrp_data);
                }else{
                    $nrp_count = 0;
                }
                $nrpnamearr = $data['nrpnamearr'];
                $nrp_license_number = $data['nrp_license_number'];
                $nrp_expiry = $data['nrp_expiry'];
                $nrp_upload_certification = $data['nrp_upload_certification'];

                $nrp_data_array = array();

                for($i=0;$i<$nrp_count;$i++){
                    if(!empty($nrp_upload_certification[$i])){
                        $name1=$nrp_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $nrp_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->nrp_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->nrp_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $nrp_data_array[] = array("nrp_certification_id"=>$nrpnamearr[$i],"nrp_license_number"=>$nrp_license_number[$i],"nrp_expiry"=>$nrp_expiry[$i],"nrp_upload_certification"=>$name);
                }

                if(!empty($nrp_data_array)){
                    $nrp_data_json = json_encode($nrp_data_array);
                }else{
                    $nrp_data_json = '';
                }

                $pls_data = $data['pls_data'];
                if($pls_data){
                    $pls_count = count($pls_data);
                }else{
                    $pls_count = 0;
                }
                $plsnamearr = $data['plsnamearr'];
                $pls_license_number = $data['pls_license_number'];
                $pls_expiry = $data['pls_expiry'];
                $pls_upload_certification = $data['pls_upload_certification'];

                $pls_data_array = array();

                for($i=0;$i<$pls_count;$i++){
                    if(!empty($pls_upload_certification[$i])){
                        $name1=$pls_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $pls_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->pals_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->pals_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $pls_data_array[] = array("pls_certification_id"=>$plsnamearr[$i],"pls_license_number"=>$pls_license_number[$i],"pls_expiry"=>$pls_expiry[$i],"pls_upload_certification"=>$name);
                }

                if(!empty($pls_data_array)){
                    $pls_data_json = json_encode($pls_data_array);
                }else{
                    $pls_data_json = '';
                }

                $rn_data = $data['rn_data'];
                if($rn_data){
                    $rn_count = count($rn_data);
                }else{
                    $rn_count = 0;
                }
                $rnnamearr = $data['rnnamearr'];
                $rn_license_number = $data['rn_license_number'];
                $rn_expiry = $data['rn_expiry'];
                $rn_upload_certification = $data['rn_upload_certification'];

                $rn_data_array = array();

                for($i=0;$i<$rn_count;$i++){
                    if(!empty($rn_upload_certification[$i])){
                        $name1=$rn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $rn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->rn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->rn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $rn_data_array[] = array("rn_certification_id"=>$rnnamearr[$i],"rn_license_number"=>$rn_license_number[$i],"rn_expiry"=>$rn_expiry[$i],"rn_upload_certification"=>$name);
                }

                if(!empty($rn_data_array)){
                    $rn_data_json = json_encode($rn_data_array);
                }else{
                    $rn_data_json = '';
                }

                $np_data = $data['np_data'];
                if($np_data){
                    $np_count = count($np_data);
                }else{
                    $np_count = 0;
                }
                $npnamearr = $data['npnamearr'];
                $np_license_number = $data['np_license_number'];
                $np_expiry = $data['np_expiry'];
                $np_upload_certification = $data['np_upload_certification'];

                $np_data_array = array();

                for($i=0;$i<$np_count;$i++){
                    if(!empty($np_upload_certification[$i])){
                        $name1=$np_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $np_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->np_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->np_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $np_data_array[] = array("np_certification_id"=>$npnamearr[$i],"np_license_number"=>$np_license_number[$i],"np_expiry"=>$np_expiry[$i],"np_upload_certification"=>$name);
                }

                if(!empty($np_data_array)){
                    $np_data_json = json_encode($np_data_array);
                }else{
                    $np_data_json = '';
                }

                $cn_data = $data['cn_data'];
                if($cn_data){
                    $cn_count = count($cn_data);
                }else{
                    $cn_count = 0;
                }
                $cnnamearr = $data['cnnamearr'];
                $cn_license_number = $data['cn_license_number'];
                $cn_expiry = $data['cn_expiry'];
                $cn_upload_certification = $data['cn_upload_certification'];

                $cn_data_array = array();

                for($i=0;$i<$cn_count;$i++){
                    if(!empty($cn_upload_certification[$i])){
                        $name1=$cn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $cn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->cna_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->cna_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $cn_data_array[] = array("cn_certification_id"=>$cnnamearr[$i],"cn_license_number"=>$cn_license_number[$i],"cn_expiry"=>$cn_expiry[$i],"cn_upload_certification"=>$name);
                }
      

                if(!empty($cn_data_array)){
                    $cn_data_json = json_encode($cn_data_array);
                }else{
                    $cn_data_json = '';
                }

                $lpn_data = $data['lpn_data'];
                if($lpn_data){
                    $lpn_count = count($lpn_data);
                }else{
                    $lpn_count = 0;
                }
                $lpnnamearr = $data['lpnnamearr'];
                $lpn_license_number = $data['lpn_license_number'];
                $lpn_expiry = $data['lpn_expiry'];
                $lpn_upload_certification = $data['lpn_upload_certification'];

                $lpn_data_array = array();

                for($i=0;$i<$lpn_count;$i++){
                    if(!empty($lpn_upload_certification[$i])){
                        $name1=$lpn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $lpn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->lpn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->lpn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $lpn_data_array[] = array("lpn_certification_id"=>$lpnnamearr[$i],"lpn_license_number"=>$lpn_license_number[$i],"lpn_expiry"=>$lpn_expiry[$i],"lpn_upload_certification"=>$name);
                }

                if(!empty($lpn_data_array)){
                    $lpn_data_json = json_encode($lpn_data_array);
                }else{
                    $lpn_data_json = '';
                }

                $crna_data = $data['crn_data'];
                if($crna_data){
                    $crna_count = count($crna_data);
                }else{
                    $crna_count = 0;
                }
                $crnanamearr = $data['crnanamearr'];
                //print_r($crna_count);die;
                $crna_license_number = $data['crna_license_number'];
                $crna_expiry = $data['crna_expiry'];
                $crna_upload_certification = $data['crna_upload_certification'];

                $crna_data_array = array();

                for($i=0;$i<$crna_count;$i++){
                    if(!empty($crna_upload_certification[$i])){
                        $name1=$crna_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $crna_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->crna_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->crna_upload_certification;
                        }else{
                            $name = "";
                        }
                    }        
                    $crna_data_array[] = array("crna_certification_id"=>$crnanamearr[$i],"crna_license_number"=>$crna_license_number[$i],"crna_expiry"=>$crna_expiry[$i],"crna_upload_certification"=>$name);
                }
                
                if(!empty($crna_data_array)){
                    $crna_data_json = json_encode($crna_data_array);
                }else{
                    $crna_data_json = '';
                }

                $cnm_data = $data['cnm_data'];
                if($cnm_data){
                    $cnm_count = count($cnm_data);
                }else{
                    $cnm_count = 0;
                }
                $cnmnamearr = $data['cnmnamearr'];
                //print_r($crna_count);die;
                $cnm_license_number = $data['cnm_license_number'];
                $cnm_expiry = $data['cnm_expiry'];
                $cnm_upload_certification = $data['cnm_upload_certification'];

                $cnm_data_array = array();

                for($i=0;$i<$cnm_count;$i++){
                    if(!empty($cnm_upload_certification[$i])){
                        $name1=$cnm_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $cnm_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->cnm_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->cnm_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $cnm_data_array[] = array("cnm_certification_id"=>$cnmnamearr[$i],"cnm_license_number"=>$cnm_license_number[$i],"cnm_expiry"=>$cnm_expiry[$i],"cnm_upload_certification"=>$name);
                }
                
                if(!empty($cnm_data_array)){
                    $cnm_data_json = json_encode($cnm_data_array);
                }else{
                    $cnm_data_json = '';
                }

                $ons_data = $data['ons_data'];
                if($ons_data){
                    $ons_count = count($ons_data);
                }else{
                    $ons_count = 0;
                }
                $onsnamearr = $data['onsnamearr'];
                //print_r($crna_count);die;
                $ons_license_number = $data['ons_license_number'];
                $ons_expiry = $data['ons_expiry'];
                $ons_upload_certification = $data['ons_upload_certification'];

                $ons_data_array = array();
      
                for($i=0;$i<$ons_count;$i++){
                    if(!empty($ons_upload_certification[$i])){
                        $name1=$ons_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $ons_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->ons_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->ons_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $ons_data_array[] = array("ons_certification_id"=>$onsnamearr[$i],"ons_license_number"=>$ons_license_number[$i],"ons_expiry"=>$ons_expiry[$i],"ons_upload_certification"=>$name);
                }
                
                if(!empty($ons_data_array)){
                    $ons_data_json = json_encode($ons_data_array);
                }else{
                    $ons_data_json = '';
                }

                $msw_data = $data['msw_data'];
                if($msw_data){
                    $msw_count = count($msw_data);
                }else{
                    $msw_count = 0;
                }
                $mswnamearr = $data['mswnamearr'];
                
                $msw_license_number = $data['msw_license_number'];
                $msw_expiry = $data['msw_expiry'];
                $msw_upload_certification = $data['msw_upload_certification'];

                $msw_data_array = array();

                for($i=0;$i<$msw_count;$i++){
                    if(!empty($msw_upload_certification[$i])){
                        $name1=$msw_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $msw_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->msw_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->msw_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $msw_data_array[] = array("msw_certification_id"=>$mswnamearr[$i],"msw_license_number"=>$msw_license_number[$i],"msw_expiry"=>$msw_expiry[$i],"msw_upload_certification"=>$name);
                }
                //print_r(count($msw_data_array));die;
                if(!empty($msw_data_array)){
                    $msw_data_json = json_encode($msw_data_array);
                }else{
                    $msw_data_json = '';
                }

                $ain_data = $data['ain_data'];
                if($ain_data){
                    $ain_count = count($ain_data);
                }else{
                    $ain_count = 0;
                }
                $ainnamearr = $data['ainnamearr'];
                //print_r($crna_count);die;
                $ain_license_number = $data['ain_license_number'];
                $ain_expiry = $data['ain_expiry'];
                $ain_upload_certification = $data['ain_upload_certification'];

                $ain_data_array = array();

                for($i=0;$i<$ain_count;$i++){
                    if(!empty($ain_upload_certification[$i])){
                        $name1=$ain_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $ain_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->ain_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->ain_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $ain_data_array[] = array("ain_certification_id"=>$ainnamearr[$i],"ain_license_number"=>$ain_license_number[$i],"ain_expiry"=>$ain_expiry[$i],"ain_upload_certification"=>$name);
                }
                
                if(!empty($ain_data_array)){
                    $ain_data_json = json_encode($ain_data_array);
                }else{
                    $ain_data_json = '';
                }

                $rpn_data =$data['rpn_data'];
                if($rpn_data){
                    $rpn_count = count($rpn_data);
                }else{
                    $rpn_count = 0;
                }
                $rpnnamearr = $data['rpnnamearr'];
                //print_r($crna_count);die;
                $rpn_license_number = $data['rpn_license_number'];
                $rpn_expiry = $data['rpn_expiry'];
                $rpn_upload_certification = $data['rpn_upload_certification'];

                $rpn_data_array = array();

                for($i=0;$i<$rpn_count;$i++){
                    if(!empty($rpn_upload_certification[$i])){
                        $name1=$rpn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $rpn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->rpn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->rpn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $rpn_data_array[] = array("rpn_certification_id"=>$rpnnamearr[$i],"rpn_license_number"=>$rpn_license_number[$i],"rpn_expiry"=>$rpn_expiry[$i],"rpn_upload_certification"=>$name);
                }
                
                if(!empty($rpn_data_array)){
                    $rpn_data_json = json_encode($rpn_data_array);
                }else{
                    $rpn_data_json = '';
                }

                if($data['nl_data']){
                    $nl_data = json_encode($data['nl_data']);
                }else{
                    $nl_data = '';
                }

                $file = $data['upload_degree'];
                if(!empty($file)){
                    $destinationPath = public_path() . '/uploads/education_degree';
                    $file->move($destinationPath,time().$file->getClientOriginalName());
                    $degree_transcript = time().$file->getClientOriginalName();
                }

                $training_courses = $data['training_courses'];
                $additional_license_number = $data['additional_license_number'];
                $additional_expiry = $data['additional_expiry'];
                $additional_upload_certification = $data['additional_upload_certification'];

                $certificate_array = array();
                for($i=0;$i<count($training_courses);$i++){
                    if(!empty($additional_upload_certification[$i])){
                        $name1=$additional_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $additional_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->additional_training_data);
                        $name = $certificate_data[$i]->additional_upload_certification;
                    }
                    
                    $certificate_array[] = array("training_courses"=>$training_courses[$i],"additional_license_number"=>$additional_license_number[$i],"additional_expiry"=>$additional_expiry[$i],"additional_upload_certification"=>$name);
                }

                $certificate_json = json_encode($certificate_array);
                $user_id=$user_id->id;

                $CER=json_encode($data['professional_certification']);            
                $allData['institution'] = $data['institution'];
                $allData['most_relevant'] = $data['most_relevant'];
                $allData['graduate_start_date'] = $data['graduation_start_date'];
                $allData['professional_certifications'] = $CER;

                $allData['acls_data'] = $acls_data_json;
                $allData['bls_data']  = $bls_data_json;
                $allData['cpr_data']  = $cpr_data_json;
                $allData['nrp_data']  = $nrp_data_json;
                $allData['pals_data'] = $pls_data_json;
                $allData['rn_data']   = $rn_data_json;
                $allData['np_data']   = $np_data_json;
                $allData['cna_data'] =  $cn_data_json;
             
                $allData['lpn_data']  = $lpn_data_json;
                $allData['crna_data'] = $crna_data_json;
                $allData['cnm_data']  = $cnm_data_json;
                $allData['ons_data']  = $ons_data_json;
                $allData['msw_data']  = $msw_data_json;
                
                $allData['ain_data']  = $ain_data_json;
                $allData['rpn_data']  = $rpn_data_json;
                $allData['nl_data']   = $nl_data;
                $allData['degree_transcript'] = $degree_transcript;
                $allData['additional_training_data'] = $certificate_json;
                $allData['user_id']  = $user_id;
                $allData['complete_status'] = 1;
                $allData['training_courses']  = '';
               
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
                // $allData['user_id'] = $user_id->id;

                $year_experience = $data['assistent_level'];
                $user_id = $user_id->id;
                $previous_employer_name = $data['previous_employer_name'];
                $positions_held = json_encode( $data['positions_held']);
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $present_box = $data['present_box'];
                $job_responeblities = $data['job_responeblities'];
                $achievements = $data['achievements'];
                $employeement_type = $data['employeement_type'];
                $skills_compantancies = json_encode($data['skills_compantancies']);
                $type_of_evidence = json_encode($data['type_of_evidence']);
                $i = 0; 
                
                $work_experience_array = array();
                foreach ($previous_employer_name as $pname) {
                    $previous_employer_name1 = $pname;
                    $positions_held1 = $positions_held[$i];
                    $start_date1 = $start_date[$i];
                    $end_date1 = $end_date[$i];
                    
                    if (isset($present_box[$i])) {
                            $p_box = 1;
                        }else{
                            $p_box = 0;
                        }
                    $employeement_type1 = $employeement_type[$i];
                    $job_responeblities1 = $job_responeblities[$i];
                    $achievements1 = $achievements[$i];

                    $work_experience_array[] = array("previous_employer_name1"=>$previous_employer_name1,"positions_held1"=>$positions_held1,"start_date1"=>$start_date1,"end_date1"=>$end_date1,"present_box1"=>$p_box,"employeement_type1"=>$employeement_type1,"job_responeblities1"=>$job_responeblities1,"achievements1"=>$achievements1);
                    $i++;
                }

                if(!empty($work_experience_array)){
                    $work_experience_json = json_encode($work_experience_array);
                }else{
                    $work_experience_json = '';
                }
  
                $file = $data['upload_evidence'];

                
                
                //$post = User::find($request->user_id);

                if(!empty($file)){
                    $destinationPath = public_path() . '/uploads/evidence';

                    $file->move($destinationPath,time().$file->getClientOriginalName());
                    $upload_evidence = time().$file->getClientOriginalName();
                    
                }else{
                    $upload_evidence = $getedudata->upload_evidence;
                }

   
                $post = new ExperienceModel();
                $post->user_id = $user_id; 
                         
                //$post->year_experience = $year_experience;
                $post->work_experience = $work_experience_json;
                $post->skills_compantancies = $skills_compantancies;
                $post->upload_evidence = $upload_evidence;
                $post->evidence_type = $type_of_evidence;
                $post->complete_status = 1;
                $run = $post->save();

                // $run=ExperienceModel::create($allData);

                if($run){               
                    $allData['assistent_level'] = $year_experience;

                    User::where('id', $user_id)->update([
                        'assistent_level' => $year_experience,
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

            }else if($data['tab'] == 'tab14'){               
                $email=Session::get('nurseemail');       
                $user_id=User::where('email',$email)->first();
                // /$allData['medical_facilities'] = isset($data['language_picker_select']) ? 'Yes' : 'No';
                $allData['agencies'] = isset($data['visibleToAgencies']) ? 'Yes' : 'No';
                $allData['individuals'] = isset($data['individuals']) ? 'Yes' : 'No';
                $allData['profile_status1'] = $data['profile_status'];
                //$update['unavailable_profile_status'] = isset($request->profile_status) ? 'Yes' : 'No';
                $allData['available_date'] = $data['available_date'];
                $run = User::where('id',$user_id->id)->update($allData);
                $param='Additional Informationyy';

            }else if($data['tab'] == 'tab15'){               

                $email=Session::get('nurseemail');       
                $user_id=User::where('email',$email)->first();
                $first_name = $data['first_name'];        
                $last_name = $data['last_name'];
                $email = $data['email'];
                $phone_no = $data['phone_no'];
                $reference_relationship = $data['reference_relationship'];
                $worked_together = $data['worked_together'];
                $position_with_referee = $data['position_with_referee'];
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $still_working = $data['still_working'];
                $reference_no = $data['reference_no'];

                for($i=0;$i<count($first_name);$i++){

                if (isset($still_working[$i])) {
                    $working = 1;
                }else{
                    $working = 0;
                }
                $referee = new AddReferee;
                $referee->referee_no = $i+1;
                $referee->user_id = $user_id->id;
                $referee->first_name = $first_name[$i];
                $referee->last_name = $last_name[$i];
                $referee->email = $email[$i];
                $referee->phone_no = $phone_no[$i];
                $referee->relationship = $reference_relationship[$i];
                $referee->worked_together = $worked_together[$i];
                $referee->position_with_referee = $position_with_referee[$i];
                $referee->start_date = $start_date[$i];
                $referee->end_date = $end_date[$i];
                $referee->still_working = $working;
                $run = $referee->save();
              }

              $param='References';
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

    public function EditNursePost($data)
    {  

        try {
            if($data['tab'] == 'tab1'){
                $finduser =  User::where('id',$data['nurse_id'])->first();
                $emailExists = User::where('email', $data['email'])
                        ->where('id', '!=', $data['nurse_id'])
                        ->exists(); 
                                        
                if($emailExists){
                    return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
                }

                
                if ($data['profile_image'] != 'null') {

                    $profile_img = $data['profile_image'];
                    $destinationPath=public_path().'/nurse/assets/imgs/';
                    $profile_img_name=$profile_img->getClientOriginalName();                    
                    $profile_img->move($destinationPath,$profile_img->getClientOriginalName());  
                    $profilename = 'nurse/assets/imgs/' . $profile_img_name;  
                        
                }else{
                    $profilename = $finduser->profile_img;
                }

                 if ($data['passwordI'] != null) {

                    $password = $data['passwordI'];

                 }else{
                    $password = $finduser->ps;
                 }

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
                $allData['profile_img'] = $profilename;
                $allData['emegency_country_code'] = $data['country_code_mobile'];
                $allData['emergency_country_iso'] = $data['country_iso_mobile'];
                $allData['nationality'] = $data['nationality'];
                $allData['emailVerified'] = '1';
                $allData['user_stage'] = '1';
                $allData['password'] =  Hash::make($password);
                $allData['ps'] =  $password;

                $run=$this->nurseRepository->updateData(['id'=>$finduser->id], $allData);

                $param='Basic detail';
            
            }else if($data['tab'] == 'tab2'){
                 $finduser =  User::where('id',$data['nurse_id'])->first();
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
                $allData['user_stage'] = '5';
                $allData['professional_info_status'] = $data['declare_information'];
                $email=Session::get('nurseemail');
                // dd($allData);
                $run=$this->nurseRepository->updateData(['id'=>$finduser->id], $allData);
                $param='Professional detail';

            // session()->forget('nurseemail');
            }else if($data['tab'] == 'tab3'){
               $user_id = $data['user_id'];
                  
                // $getuser = User::where('id',$data['user_id'])->fisrt();
                $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

                $file = $data['degree_transcript'];
                $dtranaimg = json_decode($getedudata->degree_transcript);

                $dtranimgs = Helpers::multipleFileUpload($file,$dtranaimg);
               
                
                $bls_data = $data['bls_data'];
                if($bls_data){
                    $bls_count = count($bls_data);
                }else{
                    $bls_count = 0;
                }
                $bls_license_number = $data['bls_license_number'];
                $bls_expiry =$data['bls_expiry'];
                $bls_upload_certification =$data['bls_upload_certification'];

                $bls_data_array = array();

                $certificate_data = json_decode($getedudata->bls_data);

                for($i=0;$i<$bls_count;$i++){
                    if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                        $blsimg = json_decode($certificate_data[$i]->bls_upload_certification);
                    }else{
                        $blsimg = '';
                    }
                    
                    //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
                    if(!empty($bls_upload_certification[$i])){
                        $bls_img = Helpers::multipleFileUpload($bls_upload_certification[$i],$blsimg);
                    }else{
                        $bls_img = Helpers::multipleFileUpload('',$blsimg);
                    }
                    
                    $bls_data_array[] = array("bls_certification_id"=>$bls_data[$i],"bls_license_number"=>$bls_license_number[$i],"bls_expiry"=>$bls_expiry[$i],"bls_upload_certification"=>$bls_img);
                }

                if(!empty($bls_data_array)){
                    $bls_data_json = json_encode($bls_data_array);
                }else{
                    $bls_data_json = '';
                }

                

                $acls_data = $data['acls_data'];
                if($acls_data){
                    $acls_count = count($acls_data);
                }else{
                    $acls_count = 0;
                }
                $aclsnamearr = $data['aclsnamearr'];
                $acls_license_number =$data['acls_license_number'];
                $acls_expiry = $data['acls_expiry'];
                $acls_upload_certification = $data['acls_upload_certification'];
                // print_r($acls_upload_certification);

                $acls_data_array = array();

                $certificate_data = json_decode($getedudata->acls_data);

                for($i=0;$i<$acls_count;$i++){
                    if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                        $aclsimg = json_decode($certificate_data[$i]->acls_upload_certification);
                    }else{
                        $aclsimg = '';
                    }
                    //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
                    if(!empty($acls_upload_certification[$i])){
                        // echo "test";die;
                        $acls_img = Helpers::multipleFileUpload($acls_upload_certification[$i],$aclsimg);
                    }else{
                        $acls_img = Helpers::multipleFileUpload('',$aclsimg);
                    }
                 
                    $acls_data_array[] = array("acls_certification_id"=>$aclsnamearr[$i],"acls_license_number"=>$acls_license_number[$i],"acls_expiry"=>$acls_expiry[$i],"acls_upload_certification"=>$acls_img);
                }

                if(!empty($acls_data_array)){
                    $acls_data_json = json_encode($acls_data_array);
                }else{
                    $acls_data_json = '';
                }

                $cpr_data = $data['cpr_data'];
                if($cpr_data){
                    $cpr_count = count($cpr_data);
                }else{
                    $cpr_count = 0;
                }
                $cprnamearr = $data['cprnamearr'];

                $cpr_license_number = $data['cpr_license_number'];
                $cpr_expiry = $data['cpr_expiry'];
                $cpr_upload_certification = $data['cpr_upload_certification'];

                $cpr_data_array = array();

                $certificate_data = json_decode($getedudata->cpr_data);

                for($i=0;$i<$cpr_count;$i++){
                    if(!empty($certificate_data) && array_key_exists($i,$certificate_data)){
                        $cprimg = json_decode($certificate_data[$i]->cpr_upload_certification);
                    }else{
                        $cprimg = '';
                    }
                    
                    //print_r(json_decode($certificate_data[$i]->acls_upload_certification));
                    if(!empty($cpr_upload_certification[$i])){
                        $cpr_img = Helpers::multipleFileUpload($cpr_upload_certification[$i],$cprimg);
                    }else{
                        $cpr_img = Helpers::multipleFileUpload('',$cprimg);
                    }
                    
                    $cpr_data_array[] = array("cpr_certification_id"=>$cprnamearr[$i],"cpr_license_number"=>$cpr_license_number[$i],"cpr_expiry"=>$cpr_expiry[$i],"cpr_upload_certification"=>$cpr_img);
                }

                if(!empty($cpr_data_array)){
                    $cpr_data_json = json_encode($cpr_data_array);
                    
                }else{
                    $cpr_data_json = '';
                }

                $nrp_data = $data['nrp_data'];
                if($nrp_data){
                    $nrp_count = count($nrp_data);
                }else{
                    $nrp_count = 0;
                }
                $nrpnamearr = $data['nrpnamearr'];
                $nrp_license_number = $data['nrp_license_number'];
                $nrp_expiry = $data['nrp_expiry'];
                $nrp_upload_certification = $data['nrp_upload_certification'];

                $nrp_data_array = array();

                for($i=0;$i<$nrp_count;$i++){
                    if(!empty($nrp_upload_certification[$i])){
                        $name1=$nrp_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $nrp_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->nrp_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->nrp_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $nrp_data_array[] = array("nrp_certification_id"=>$nrpnamearr[$i],"nrp_license_number"=>$nrp_license_number[$i],"nrp_expiry"=>$nrp_expiry[$i],"nrp_upload_certification"=>$name);
                }

                if(!empty($nrp_data_array)){
                    $nrp_data_json = json_encode($nrp_data_array);
                }else{
                    $nrp_data_json = '';
                }

                $pls_data = $data['pls_data'];
                if($pls_data){
                    $pls_count = count($pls_data);
                }else{
                    $pls_count = 0;
                }
                $plsnamearr = $data['plsnamearr'];
                $pls_license_number = $data['pls_license_number'];
                $pls_expiry = $data['pls_expiry'];
                $pls_upload_certification = $data['pls_upload_certification'];

                $pls_data_array = array();

                for($i=0;$i<$pls_count;$i++){
                    if(!empty($pls_upload_certification[$i])){
                        $name1=$pls_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $pls_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->pals_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->pals_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $pls_data_array[] = array("pls_certification_id"=>$plsnamearr[$i],"pls_license_number"=>$pls_license_number[$i],"pls_expiry"=>$pls_expiry[$i],"pls_upload_certification"=>$name);
                }

                if(!empty($pls_data_array)){
                    $pls_data_json = json_encode($pls_data_array);
                }else{
                    $pls_data_json = '';
                }

                $rn_data = $data['rn_data'];
                if($rn_data){
                    $rn_count = count($rn_data);
                }else{
                    $rn_count = 0;
                }
                $rnnamearr = $data['rnnamearr'];
                $rn_license_number = $data['rn_license_number'];
                $rn_expiry = $data['rn_expiry'];
                $rn_upload_certification = $data['rn_upload_certification'];

                $rn_data_array = array();

                for($i=0;$i<$rn_count;$i++){
                    if(!empty($rn_upload_certification[$i])){
                        $name1=$rn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $rn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->rn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->rn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $rn_data_array[] = array("rn_certification_id"=>$rnnamearr[$i],"rn_license_number"=>$rn_license_number[$i],"rn_expiry"=>$rn_expiry[$i],"rn_upload_certification"=>$name);
                }

                if(!empty($rn_data_array)){
                    $rn_data_json = json_encode($rn_data_array);
                }else{
                    $rn_data_json = '';
                }

                $np_data = $data['np_data'];
                if($np_data){
                    $np_count = count($np_data);
                }else{
                    $np_count = 0;
                }
                $npnamearr = $data['npnamearr'];
                $np_license_number = $data['np_license_number'];
                $np_expiry = $data['np_expiry'];
                $np_upload_certification = $data['np_upload_certification'];

                $np_data_array = array();

                for($i=0;$i<$np_count;$i++){
                    if(!empty($np_upload_certification[$i])){
                        $name1=$np_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $np_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->np_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->np_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $np_data_array[] = array("np_certification_id"=>$npnamearr[$i],"np_license_number"=>$np_license_number[$i],"np_expiry"=>$np_expiry[$i],"np_upload_certification"=>$name);
                }

                if(!empty($np_data_array)){
                    $np_data_json = json_encode($np_data_array);
                }else{
                    $np_data_json = '';
                }

                $cn_data = $data['cn_data'];
                if($cn_data){
                    $cn_count = count($cn_data);
                }else{
                    $cn_count = 0;
                }
                $cnnamearr = $data['cnnamearr'];
                $cn_license_number = $data['cn_license_number'];
                $cn_expiry = $data['cn_expiry'];
                $cn_upload_certification = $data['cn_upload_certification'];

                $cn_data_array = array();

                for($i=0;$i<$cn_count;$i++){
                    if(!empty($cn_upload_certification[$i])){
                        $name1=$cn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $cn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->cna_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->cna_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $cn_data_array[] = array("cn_certification_id"=>$cnnamearr[$i],"cn_license_number"=>$cn_license_number[$i],"cn_expiry"=>$cn_expiry[$i],"cn_upload_certification"=>$name);
                }
      

                if(!empty($cn_data_array)){
                    $cn_data_json = json_encode($cn_data_array);
                }else{
                    $cn_data_json = '';
                }

                $lpn_data = $data['lpn_data'];
                if($lpn_data){
                    $lpn_count = count($lpn_data);
                }else{
                    $lpn_count = 0;
                }
                $lpnnamearr = $data['lpnnamearr'];
                $lpn_license_number = $data['lpn_license_number'];
                $lpn_expiry = $data['lpn_expiry'];
                $lpn_upload_certification = $data['lpn_upload_certification'];

                $lpn_data_array = array();

                for($i=0;$i<$lpn_count;$i++){
                    if(!empty($lpn_upload_certification[$i])){
                        $name1=$lpn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $lpn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->lpn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->lpn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $lpn_data_array[] = array("lpn_certification_id"=>$lpnnamearr[$i],"lpn_license_number"=>$lpn_license_number[$i],"lpn_expiry"=>$lpn_expiry[$i],"lpn_upload_certification"=>$name);
                }

                if(!empty($lpn_data_array)){
                    $lpn_data_json = json_encode($lpn_data_array);
                }else{
                    $lpn_data_json = '';
                }

                $crna_data = $data['crn_data'];
                if($crna_data){
                    $crna_count = count($crna_data);
                }else{
                    $crna_count = 0;
                }
                $crnanamearr = $data['crnanamearr'];
                //print_r($crna_count);die;
                $crna_license_number = $data['crna_license_number'];
                $crna_expiry = $data['crna_expiry'];
                $crna_upload_certification = $data['crna_upload_certification'];

                $crna_data_array = array();

                for($i=0;$i<$crna_count;$i++){
                    if(!empty($crna_upload_certification[$i])){
                        $name1=$crna_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $crna_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->crna_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->crna_upload_certification;
                        }else{
                            $name = "";
                        }
                    }        
                    $crna_data_array[] = array("crna_certification_id"=>$crnanamearr[$i],"crna_license_number"=>$crna_license_number[$i],"crna_expiry"=>$crna_expiry[$i],"crna_upload_certification"=>$name);
                }
                
                if(!empty($crna_data_array)){
                    $crna_data_json = json_encode($crna_data_array);
                }else{
                    $crna_data_json = '';
                }

                $cnm_data = $data['cnm_data'];
                if($cnm_data){
                    $cnm_count = count($cnm_data);
                }else{
                    $cnm_count = 0;
                }
                $cnmnamearr = $data['cnmnamearr'];
                //print_r($crna_count);die;
                $cnm_license_number = $data['cnm_license_number'];
                $cnm_expiry = $data['cnm_expiry'];
                $cnm_upload_certification = $data['cnm_upload_certification'];

                $cnm_data_array = array();

                for($i=0;$i<$cnm_count;$i++){
                    if(!empty($cnm_upload_certification[$i])){
                        $name1=$cnm_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $cnm_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->cnm_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->cnm_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $cnm_data_array[] = array("cnm_certification_id"=>$cnmnamearr[$i],"cnm_license_number"=>$cnm_license_number[$i],"cnm_expiry"=>$cnm_expiry[$i],"cnm_upload_certification"=>$name);
                }
                
                if(!empty($cnm_data_array)){
                    $cnm_data_json = json_encode($cnm_data_array);
                }else{
                    $cnm_data_json = '';
                }

                $ons_data = $data['ons_data'];
                if($ons_data){
                    $ons_count = count($ons_data);
                }else{
                    $ons_count = 0;
                }
                $onsnamearr = $data['onsnamearr'];
                //print_r($crna_count);die;
                $ons_license_number = $data['ons_license_number'];
                $ons_expiry = $data['ons_expiry'];
                $ons_upload_certification = $data['ons_upload_certification'];

                $ons_data_array = array();
      
                for($i=0;$i<$ons_count;$i++){
                    if(!empty($ons_upload_certification[$i])){
                        $name1=$ons_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $ons_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->ons_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->ons_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $ons_data_array[] = array("ons_certification_id"=>$onsnamearr[$i],"ons_license_number"=>$ons_license_number[$i],"ons_expiry"=>$ons_expiry[$i],"ons_upload_certification"=>$name);
                }
                
                if(!empty($ons_data_array)){
                    $ons_data_json = json_encode($ons_data_array);
                }else{
                    $ons_data_json = '';
                }

                $msw_data = $data['msw_data'];
                if($msw_data){
                    $msw_count = count($msw_data);
                }else{
                    $msw_count = 0;
                }
                $mswnamearr = $data['mswnamearr'];
                
                $msw_license_number = $data['msw_license_number'];
                $msw_expiry = $data['msw_expiry'];
                $msw_upload_certification = $data['msw_upload_certification'];

                $msw_data_array = array();

                for($i=0;$i<$msw_count;$i++){
                    if(!empty($msw_upload_certification[$i])){
                        $name1=$msw_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $msw_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->msw_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->msw_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $msw_data_array[] = array("msw_certification_id"=>$mswnamearr[$i],"msw_license_number"=>$msw_license_number[$i],"msw_expiry"=>$msw_expiry[$i],"msw_upload_certification"=>$name);
                }
                //print_r(count($msw_data_array));die;
                if(!empty($msw_data_array)){
                    $msw_data_json = json_encode($msw_data_array);
                }else{
                    $msw_data_json = '';
                }

                $ain_data = $data['ain_data'];
                if($ain_data){
                    $ain_count = count($ain_data);
                }else{
                    $ain_count = 0;
                }
                $ainnamearr = $data['ainnamearr'];
                //print_r($crna_count);die;
                $ain_license_number = $data['ain_license_number'];
                $ain_expiry = $data['ain_expiry'];
                $ain_upload_certification = $data['ain_upload_certification'];

                $ain_data_array = array();

                for($i=0;$i<$ain_count;$i++){
                    if(!empty($ain_upload_certification[$i])){
                        $name1=$ain_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $ain_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->ain_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->ain_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $ain_data_array[] = array("ain_certification_id"=>$ainnamearr[$i],"ain_license_number"=>$ain_license_number[$i],"ain_expiry"=>$ain_expiry[$i],"ain_upload_certification"=>$name);
                }
                
                if(!empty($ain_data_array)){
                    $ain_data_json = json_encode($ain_data_array);
                }else{
                    $ain_data_json = '';
                }

                $rpn_data =$data['rpn_data'];
                if($rpn_data){
                    $rpn_count = count($rpn_data);
                }else{
                    $rpn_count = 0;
                }
                $rpnnamearr = $data['rpnnamearr'];
                //print_r($crna_count);die;
                $rpn_license_number = $data['rpn_license_number'];
                $rpn_expiry = $data['rpn_expiry'];
                $rpn_upload_certification = $data['rpn_upload_certification'];

                $rpn_data_array = array();

                for($i=0;$i<$rpn_count;$i++){
                    if(!empty($rpn_upload_certification[$i])){
                        $name1=$rpn_upload_certification[$i]->getClientOriginalName();
                        $name= time().$name1;
                        $destinationPathcert = public_path()."/uploads/certificates"; 
                        $rpn_upload_certification[$i]->move($destinationPathcert,$name);
                    }else{
                        $certificate_data = json_decode($getedudata->rpn_data);
                        if(!empty($certificate_data)){
                            $name = $certificate_data[$i]->rpn_upload_certification;
                        }else{
                            $name = "";
                        }
                    }
                    
                    $rpn_data_array[] = array("rpn_certification_id"=>$rpnnamearr[$i],"rpn_license_number"=>$rpn_license_number[$i],"rpn_expiry"=>$rpn_expiry[$i],"rpn_upload_certification"=>$name);
                }
                
                if(!empty($rpn_data_array)){
                    $rpn_data_json = json_encode($rpn_data_array);
                }else{
                    $rpn_data_json = '';
                }

                if($data['nl_data']){
                    $nl_data = json_encode($data['nl_data']);
                }else{
                    $nl_data = '';
                }

                $degree = json_encode($data['ndegree']);

                $institution = $data['institution'];
                
                $user_id = $data['user_id'];
                $graduation_start_date = $data['graduation_start_date'];
                
                $professional_certification = json_encode($data['professional_certification']);
                $declare_information = $data['declare_information_edu'];


                 $training_certificate = $data['training_certificate'];
                $certificate_license_number = $data['certificate_license_number'];
                $certificate_expiry = $data['certificate_expiry'];
                $regulating_body = $data['regulating_body'];
                $certificate_upload_certification = $data['certificate_upload_certification'];

                $new_certificate_array = array();
                if(!empty($training_certificate)){
                    for($i=0;$i<count($training_certificate);$i++){
                        if(!empty($certificate_upload_certification[$i])){
                            $name1=$certificate_upload_certification[$i]->getClientOriginalName();
                            $name= time().$name1;
                            $destinationPathcert = public_path()."/uploads/certificates"; 
                            $certificate_upload_certification[$i]->move($destinationPathcert,$name);
                        }else{
                            $certificate_data = json_decode($getedudata->additional_certification);
                            //print_r($certificate_data);die;
                            if(!empty($certificate_data) && !empty($certificate_data[$i])){
                                $name = $certificate_data[$i]->certificate_upload_certification;
                            }else{
                                $name = "";
                            }
                        }
                        
                        $new_certificate_array[] = array("certificate_id"=>$i+1,"training_certificate"=>$training_certificate[$i],"certificate_license_number"=>$certificate_license_number[$i],"certificate_expiry"=>$certificate_expiry[$i],"regulating_body"=>$regulating_body[$i],"certificate_upload_certification"=>$name);
                    }

                    $new_certificate_json = json_encode($new_certificate_array);
                }else{
                    $new_certificate_json = '';
                }

                // $user_id=$user_id->id;

                if(!empty($getedudata)>0){

                    $post1 = User::find( $user_id);
                    $post1->degree = $degree;
                    $post1->save();
                    
                    $run = EducationModel::where('user_id', $user_id)->
                    update([
                    'institution'=>$institution,
                    'graduate_start_date'=>$graduation_start_date,
                    'degree_transcript'=>$dtranimgs,
                    'professional_certifications'=>$professional_certification,
                    // 'licence_number'=>$license_number,
                    // 'country'=>$country,
                    // 'state'=>$state,
                    // 'expiration_date'=>$expiration_date,
                    // 'training_courses'=>$training_courses,
                    // 'training_workshops'=>$training_workshop,
                    'complete_status'=>1,
                    'declaration_status'=>$declare_information,
                    'acls_data'=>$acls_data_json,
                    'bls_data'=>$bls_data_json,
                    'cpr_data'=>$cpr_data_json,
                    'nrp_data'=>$nrp_data_json,
                    'pals_data'=>$pls_data_json,
                    'rn_data'=>$rn_data_json,
                    'np_data'=>$np_data_json,
                    'cna_data'=>$cn_data_json,
                    'lpn_data'=>$lpn_data_json,
                    'crna_data'=>$crna_data_json,
                    'cnm_data'=>$cnm_data_json,
                    'ons_data'=>$ons_data_json,
                    'msw_data'=>$msw_data_json,
                    'ain_data'=>$ain_data_json,
                    'rpn_data'=>$rpn_data_json,
                    'nl_data'=>$nl_data,
                    'additional_certification'=>$new_certificate_json
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

                $user_id = $data['user_id'];
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $institution = $data['institution'];
                $mand_continue_education = $data['mand_continue_education'];
                
                
                
                $gettrainingdata = DB::table("mandatory_training")->where("user_id",$user_id)->first();
                //$post = User::find($request->user_id);
                
                if(!empty($gettrainingdata)>0){
                 
                    
                    $run = MandatoryTrainModel::where('user_id',$user_id)->update(['start_date'=>$start_date,'end_date'=>$end_date,'institutions'=>$institution,'continuing_education'=>$mand_continue_education]);
                }else{

                    $post = new MandatoryTrainModel();
                    $post->user_id = $user_id;
                    
                    //$post->year_experience = $year_experience;
                    $post->start_date = $start_date;
                    $post->end_date = $end_date;
                    $post->institutions = $institution;
                    $post->continuing_education = $mand_continue_education;
                    
                    
                    $run = $post->save();

                }


                $param='Mandatory Training';
           
            }else if($data['tab'] == 'tab6'){
                $vaccination_record = json_encode($data['vaccination_record']);
                $user_id = $data['user_id'];
                $immunization_status = $data['immunization_status'];
                                
                $getvaccinationdata = DB::table("vaccination_front")->where("user_id",$user_id)->first();
                //$post = User::find($request->user_id);
                
                if(!empty($getvaccinationdata)>0){                    
                    $run = VaccinationFrontModel::where('user_id',$user_id)->update(['vaccination_records'=>$vaccination_record,'immunization_status'=>$immunization_status,'complete_status'=>1]);
                }else{

                    $post = new VaccinationFrontModel();
                    $post->user_id = $user_id;
                    
                    //$post->year_experience = $year_experience;
                    $post->vaccination_records = $vaccination_record;
                    $post->immunization_status = $immunization_status;
                    
                    $post->complete_status = 1;
                    $run = $post->save();

                }

                $param='Vaccination Records';
           
            }else if($data['tab'] == 'tab7'){

                if($data['type'] == 'eligibility_work'){

                $user_id=$data['user_id'];

                 $lastRecord =EligibilityToWorkModel::where('user_id',$user_id)->first();
                   

                 $image_support_documentI=$data['image_support_documentI'];
              

                 if($image_support_documentI){
                    $destinationPath=public_path().'/nurse/assets/imgs/support_document/';
                    $support_file_name=$image_support_documentI->getClientOriginalName();
                    $image_support_documentI->move($destinationPath,$image_support_documentI->getClientOriginalName());
                     $profile_image = $destinationPath;
                  }else{
                  $profile_image = $lastRecord->support_document;
                  }

                if(!empty($lastRecord)>0){
                    $run = EligibilityToWorkModel::where('user_id',$user_id)->update([
                    'user_id'=> $user_id,
                    'residency'=> $data['residency'],
                    'visa_subclass_number'=> $data['visa_subclass_number'],
                    'passport_number'=>$data['passport_number'],
                    'passport_country_of_Issue'=>$data['passport_country_of_Issue'],
                    'expiry_date'=>$data['expiry_date'],
                    'visa_grant_number'=>$data['visa_grant_number'],
                    'status'=>0,
                    ]);

                }else{  

                $allData['support_document'] = $profile_image;

                
                $allData['user_id'] = $user_id;
                $allData['residency'] = $data['residency'];
                $allData['visa_subclass_number'] = $data['visa_subclass_number'];
                $allData['passport_number'] = $data['passport_number'];
                $allData['passport_country_of_Issue'] = $data['passport_country_of_Issue'];
                $allData['expiry_date'] = $data['expiry_date'];
                $allData['visa_grant_number'] = $data['visa_grant_number'];
                $allData['status'] = 0;

                $run=EligibilityToWorkModel::insert($allData);
                }

                $param='Eligibility To Work';
              }else if ($data['type'] == 'children_check') {
                $user_id=$data['user_id'];
                
                $lastRecord =WorkingChildrenCheckModel::where('user_id',$user_id)->first();
                if(!empty($lastRecord)>0){
                    $run = WorkingChildrenCheckModel::where('user_id',$user_id)->update([
                    'user_id'=> $user_id,
                    'clearance_number'=> $data['clearance_number'],
                    'state'=> $data['clearance_state'],
                    'expiry_date'=>$data['clearance_expiry_date'],
                    ]);

                }else{
                $allData['user_id'] = $user_id;
                $allData['clearance_number'] = $data['clearance_number'];
                $allData['state'] = $data['clearance_state'];
                $allData['expiry_date'] = $data['clearance_expiry_date'];
                $run=WorkingChildrenCheckModel::insert($allData);
                }

                $param='Children Check';
               }else if ($data['type'] == 'police_check') {
            
                $user_id=$data['user_id'];
 
                $lastRecord =PoliceCheckModel::where('user_id',$user_id)->first();
                $image_support_document_policeI=$data['image_support_document_police'];
                
                if($image_support_document_policeI){
                $destinationPath=public_path().'/nurse/assets/imgs/police_check/';
                $plice_file_name=$image_support_document_policeI->getClientOriginalName();
                $image_support_document_policeI->move($destinationPath,$image_support_document_policeI->getClientOriginalName());
                $police_image = '/nurse/assets/imgs/police_check/' . $image_support_document_policeI->getClientOriginalName();
                }else{
                $police_image = $lastRecord->image;
                }

                if(!empty($lastRecord)>0){

                    $run = PoliceCheckModel::where('user_id',$user_id)->update([
                    'user_id'=> $user_id,
                    'date'=> $data['date_acquired'],
                    'image'=> $police_image
                    ]);


                }else{
    
                $allData['user_id'] =$user_id;
                $allData['date'] = $data['date_acquired'];
                $allData['image'] = $police_image;
                $run=PoliceCheckModel::insert($allData);
                }

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

            }else if($data['tab'] == 'tab14'){     
                $allData['medical_facilities'] = isset($data['medical_facilities']) ? 'Yes' : 'No';
                $allData['agencies'] = isset($data['visibleToAgencies']) ? 'Yes' : 'No';
                $allData['individuals'] = isset($data['individuals']) ? 'Yes' : 'No';
                $allData['profile_status1'] = $data['profile_status'];               
                $allData['available_date'] = $data['available_date'];
                // $run = User::where('id',$user_id->id)->update($allData);
                $run=$this->nurseRepository->updateData(['id'=>$data['nurse_id']], $allData);
                $param='Profile setting';

            }else if($data['tab'] == 'tab15'){               

     
                $user_id=$data['user_id'];
                $first_name = $data['first_name'];        
                $last_name = $data['last_name'];
                $email = $data['email'];
                $phone_no = $data['phone_no'];
                $reference_relationship = $data['reference_relationship'];
                $worked_together = $data['worked_together'];
                $position_with_referee = $data['position_with_referee'];
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $still_working = $data['still_working'];
                $reference_no = $data['reference_no'];

                $getrefereedata = DB::table("referee")->where("user_id",$user_id)->get();

                $referee_no_array = array();

                foreach ($getrefereedata as $r_data) {
                    $referee_no_array[] = $r_data->referee_no;
                }

                for($i=0;$i<count($first_name);$i++){

                if(in_array($i+1, $referee_no_array)){
                if (isset($still_working[$i])) {
                    $working = 1;
                }else{
                    $working = 0;
                }
                $run = AddReferee::where('user_id',$user_id)->where('referee_no',$i+1)->update(['first_name'=>$first_name[$i],'last_name'=>$last_name[$i],'email'=>$email[$i],'phone_no'=>$phone_no[$i],'relationship'=>$reference_relationship[$i],'worked_together'=>$worked_together[$i],'position_with_referee'=>$position_with_referee[$i],'start_date'=>$start_date[$i],'end_date'=>$end_date[$i],'still_working'=>$working]);
               }else{
                    if (isset($still_working[$i])) {
                        $working = 1;
                    }else{
                        $working = 0;
                    }
                    $referee = new AddReferee;
                    $referee->referee_no = $i+1;
                    $referee->user_id = $user_id;
                    $referee->first_name = $first_name[$i];
                    $referee->last_name = $last_name[$i];
                    $referee->email = $email[$i];
                    $referee->phone_no = $phone_no[$i];
                    $referee->relationship = $reference_relationship[$i];
                    $referee->worked_together = $worked_together[$i];
                    $referee->position_with_referee = $position_with_referee[$i];
                    $referee->start_date = $start_date[$i];
                    $referee->end_date = $end_date[$i];
                    $referee->still_working = $working;
                    $run = $referee->save();
                }
              }

              $param='References';
            }
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.UpdateOne', ['parameter' => $param])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices/addNursePost(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
