<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use App\Repository\Eloquent\NurseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
    public function addNursePost($data)
    {
        try {

            if($data['tab'] == 'tab1'){
            Session::put('nurseemail', $data['email']);
            // dd($data['contact']);
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
            $run = $this->nurseRepository->create($allData);
            // dd($run);
            $param = 'Basic detail';
            

            }else if($data['tab'] == 'tab2'){
            $states = isset($data['states']) ? explode(',', $data['states']) : '';

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
            $email = Session::get('nurseemail');
            $run = $this->nurseRepository->updateData(['email'=>$email], $allData);
            $param = 'Professional detail';

            session()->forget('nurseemail');
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
