<?php

namespace App\Http\Controllers\medical_facilities;

use App\Models\CountryModel;
use App\Models\User;
use App\Models\ProfessionModel;
use App\Models\EligibilityToWorkModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Mail;
use Validator;
use DB;
use URL;
use Session;

use App\Models\SpecialityModel;

use App\Repository\Eloquent\SpecialityRepository;

class HomeController extends Controller
{
 protected $authServices;
 protected $specialityRepository;
      public function __construct(AuthServices $authServices, SpecialityRepository $specialityRepository){
        $this->authServices = $authServices;
        $this->specialityRepository = $specialityRepository;
    }
    public function index($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
            return view('nurse.home', compact( 'message'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function index_main($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
           return view('nurse.medical-facilities', compact( 'message'));
        } else {
            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function registraion($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
           return view('nurse.medical-facilities-registraion', compact( 'message'));
        } else {
            return redirect()->route('nurse.dashboard');
        }
        
    }
    
}