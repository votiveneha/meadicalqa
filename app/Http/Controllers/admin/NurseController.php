<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;

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
            $policeCheckVerificationData = $this->verificationRepository->getPoliceCheckVerificationData(['user_id' => $request->id]);
            $eligibilityToWorkData = $this->verificationRepository->getEligibilityToWorkData(['user_id' => $request->id]);
            $workingChildrenCheckData = $this->verificationRepository->getWorkingChildrenCheckData(['user_id' => $request->id]);
            return view('admin.profile-view',compact('profileData','professionVerificationData','policeCheckVerificationData','eligibilityToWorkData','workingChildrenCheckData'));
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
