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
                    $body .= '<p>We are excited to inform you that your account has been approved by the admin. For more details, please check your account';
                }else{
                    $body .= '<p>This mail to inform you that your account Request has been rejected due to <b>'.$request->reasonData.'.</b>';
                }
                if($request->status == 2){
                        $subject = 'Your Account Request  has been  Accepted!';
                    }else{
                        $subject = 'Your Account Request  has been Rejected!';
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
    // public function changeStatusBlockUnblock($request)
    // {
    //     try {
    //             $updateData['status'] = $request->status;
    //             $run = $this->nurseRepository->updateData(['id'=>$request->id], $updateData);
    //         if ($run == 1) {
    //             if($request->status == 1)
    //             {
    //                 $message =  __('message.unblock');
    //             }else{
    //                 $message =__('message.block');
    //             }
    //                 return response()->json(['status' => '2', 'message' =>$message]);
    //             } else {
    //                 return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
    //             }
    //     } catch (\Exception $e) {
    //         Log::error('Error in NurseServices.changeStatus(): ' . $e->getMessage());
    //         return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
    //     }
    // }
    public function changeStatusBlockUnblock($request)
    {
        try {
                // Get the user data
                $userData = $this->nurseRepository->getOneUser(['id' => $request->id]);
                 
                $updateData['status'] = $request->status;
                $run = $this->nurseRepository->updateData(['id'=>$request->id], $updateData);
            if ($run == 1) {                
                $body = 'Hello, ' . $userData->name . ' ' . $userData->lastname;
                // if($request->status == 1){
                //     $body .= '<p>We are excited to inform you that your account has been unblocked by the admin. For more details, please check your account';
                // }else{
                //     $body .= '<p>This mail to inform you that your account has been blocked.';
                // }
                // if($request->status == 1){
                //     $subject = 'Your Account has been Unblocked!';
                // }else{
                //     $subject = 'Your Account has been Blocked!';
                // }
                if ($request->status == 1) {
                    $body .= '<p>We are excited to inform you that your account has been unblocked by the admin. For more details, please check your account.</p>';
                    $subject = 'Your Account has been Unblocked!';
                } elseif ($request->status == 2) {
                    echo "test";
                    $body .= '<p>This is to inform you that your account has been blocked.</p>';
                    $subject = 'Your Account has been Blocked!';
                } 
                
                $mailData = [
                'subject' => $subject,
                'email' => $userData->email,
                'body' => $body,
                ];


                $sendMail = Mail::to($userData->email)->send(new \App\Mail\DemoMail($mailData));
                if($sendMail){
                if($request->status == 1)
                {
                    $message =  __('message.unblock');
                }else{
                    $message =__('message.block');
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
}
