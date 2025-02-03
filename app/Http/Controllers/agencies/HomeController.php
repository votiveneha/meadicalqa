<?php

namespace App\Http\Controllers\agencies;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\AuthServices;
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
           return view('nurse.agencies', compact( 'message'));
        } else {
            

            return redirect()->route('nurse.dashboard');
        }
        
    }
    public function registraion($message = '')
    {
         if (!Auth::guard('nurse_middle')->check()) {
            $title = "Login";
           return view('nurse.agencies-registraion', compact( 'message'));
        } else {
            return redirect()->route('nurse.dashboard');
        }
        
    }
    
}