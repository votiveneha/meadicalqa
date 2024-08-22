<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use App\Repository\Eloquent\NurseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

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
                print_r($mailData);die;
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
            }
            $run = $this->nurseRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Basic detail'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in NurseServices/addNursePost(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
