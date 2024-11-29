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
use App\Http\Requests\Nurseform4Request;
use App\Http\Requests\Nurseform5Request;
use App\Http\Requests\Nurseform6Request;
use App\Models\EducationModel;
use File;
use DB;
use Helpers;


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
            $RefereData  = $this->nurseRepository->getReferedetails(['user_id'=>$request->id]);
            $interviewrefData  = $this->nurseRepository->getInterviewrefdetails(['user_id'=>$request->id]);
            $personalprefData  = $this->nurseRepository->getPersonalprefdetails(['user_id'=>$request->id]);
            $findworkData  = $this->nurseRepository->getfindworkdetails(['user_id'=>$request->id]);
            $vaccinationData  = $this->nurseRepository->getvaccinationdetails(['user_id'=>$request->id]);
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => $request->id]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => $request->id]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => $request->id]);
            $proMembershipData = $this->nurseRepository->getProMembershipData(['user_id' => $request->id]);
            return view('admin.profile-view',compact('profileData','experienceData','policeCheckVerificationData','eligibilityToWorkData','workingChildrenCheckData','educationData','mandatorytrainingData',
            'interviewrefData','personalprefData','findworkData','vaccinationData','proMembershipData','RefereData'));
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
        try {
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm2(Request $request)
    {     
        try {
            return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm3(Request $request)
    {      
        try {
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm4(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm5(Nurseform5Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm6(Nurseform6Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm7(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm8(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm9(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm10(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
     public function addNursePostForm11(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm13(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm14(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addNursePostForm15(Request $request)
    {      
        try {      
           return $this->nurseServices->addNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/addNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function EditNurse(Request $request)
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
            $proMembershipData = $this->nurseRepository->getProMembershipData(['user_id' => $request->id]);
            $RefereData  = $this->nurseRepository->getReferedetails(['user_id'=>$request->id]);
            return view('admin.edit-nurse',compact('profileData','experienceData','policeCheckVerificationData','eligibilityToWorkData','workingChildrenCheckData','educationData','mandatorytrainingData',
            'interviewrefData','personalprefData','findworkData','vaccinationData','proMembershipData','RefereData'));
        } catch (\Exception $e) {
            log::error('Error in NurseController/EditNurse :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function EditNursePost(Request $request)
    {      
        try {      
           return $this->nurseServices->EditNursePost($request);
        } catch (\Exception $e) {
            log::error('Error in NurseController/EditNursePost :' . $e->getMessage() . 'in line' . $e->getLine());
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
    public function deleteCertificateImg(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        $gettransimg = json_decode($getEducationData->degree_transcript);

        

        $img_index = array_search($img, $gettransimg);
        
        array_splice($gettransimg, $img_index, 1);

        if(!empty($gettransimg)){
            $tranimgData = json_encode($gettransimg);
        }else{
            $tranimgData = '';
        }

        $deleteData = EducationModel::where('user_id',$user_id)->update(['degree_transcript'=>$tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }  
    }

    // for upload multiple  image
    public function UploadDegreeImg(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $getedudata = DB::table("user_education_cerification")->where("user_id",$user_id)->first();
        $dtranaimg = json_decode($getedudata->degree_transcript);
        $dtranimgs = Helpers::multipleFileUpload($files,$dtranaimg);
        $run = EducationModel::where('user_id',$user_id)->update(['degree_transcript'=>$dtranimgs]);
        //print_r($files);
        return $dtranimgs;
    }


    public function deleteDegImg(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;

        $getEducationData = DB::table("user_education_cerification")->where("user_id",$user_id)->first();

        $gettransimg = json_decode($getEducationData->degree_transcript);

        

        $img_index = array_search($img, $gettransimg);
        
        array_splice($gettransimg, $img_index, 1);

        if(!empty($gettransimg)){
            $tranimgData = json_encode($gettransimg);
        }else{
            $tranimgData = '';
        }

 

        $deleteData = EducationModel::where('user_id',$user_id)->update(['degree_transcript'=>$tranimgData]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

    public function uploadImgs(Request $request){
        $files = $request->file('upload_images');
        $user_id = $request->user_id;
        $country_name = $request->country_name;
        $field_name = $request->field_name;
        //print_r($files);die;

        $getedufieldsdata = DB::table("edu_fields")->where("user_id",$user_id)->first();
        //print_r($getedufieldsdata);die;
        if(empty($getedufieldsdata)){
            $acls_img = Helpers::multipleFileUpload($files,'');
            $acls_data = array($country_name => $acls_img);
            $getImg_array = $acls_data;
            DB::table("edu_fields")->insert(["user_id"=>$user_id,$field_name=>json_encode($acls_data)]);
        }else{
            $getEdufieldsData1 = (array)$getedufieldsdata;
            $getImgfield = $getEdufieldsData1[$field_name];
            $getImg_array = (array)json_decode($getImgfield);
            
            if(array_key_exists($country_name,$getImg_array)){
                $available_imgs = (array)json_decode($getImg_array[$country_name]);
                $acls_img = Helpers::multipleFileUpload($files,$available_imgs);
                $getImg_array[$country_name] = $acls_img;
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }else{
                $acls_img = Helpers::multipleFileUpload($files,'');
                $getImg_array[$country_name] = $acls_img;
                
                
                DB::table("edu_fields")->where("user_id",$user_id)->update([$field_name=>json_encode($getImg_array)]);
            }
            

        }

        return $acls_img;
    }


   public function deleteImg1(Request $request){
        $user_id = $request->user_id;
        $img = $request->img;
        $country_name = $request->country_name;
        $img_text = $request->img_text;

        $getEducationData = DB::table("edu_fields")->where("user_id",$user_id)->first();
        $getEducationData1 = (array)$getEducationData;
        $gettransimg = (array)json_decode($getEducationData1[$img_text]);
        $gettransimg1 = json_decode($gettransimg[$country_name]);

        $img_index = array_search($img, $gettransimg1);

        array_splice($gettransimg1, $img_index, 1);

        if(!empty($gettransimg1)){
            $tranimgData = json_encode($gettransimg1);
        }else{
            $tranimgData = '';
        }
        
        $gettransimg[$country_name] = $tranimgData;

        if(!empty($gettransimg)){
            $tranimgData1 = json_encode($gettransimg);
        }else{
            $tranimgData1 = '';
        }

        //print_r($gettransimg);die;

        $deleteData = DB::table("edu_fields")->where('user_id',$user_id)->update([$img_text=>$tranimgData1]);

        $destinationPath = public_path() . '/uploads/education_degree/'.$img;
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        if($deleteData){
            return 1;
        }

        //print_r($gettransimg);
        
    }

   

}
