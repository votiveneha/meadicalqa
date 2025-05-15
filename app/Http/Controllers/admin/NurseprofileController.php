<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\NurseRepository;
use App\Services\Admins\NurseServices;
use App\Repository\Eloquent\VerificationRepository;
use Illuminate\Support\Facades\Mail;

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

}