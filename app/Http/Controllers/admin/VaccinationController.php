<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\VaccinationRequest;
use App\Services\Admins\VaccinationServices;
use App\Repository\Eloquent\VaccinationRepository;

class VaccinationController extends Controller
{
    protected $vaccinationServices;
    protected $vaccinationRepository;
  
    public function __construct(VaccinationServices $vaccinationServices , VaccinationRepository $vaccinationRepository){
        $this->vaccinationServices = $vaccinationServices;
       $this->vaccinationRepository = $vaccinationRepository;
       
    }

    // this is Degree  data in database
    public function VaccinationList(Request $request)
    {
        try {
            $vaccData  = $this->vaccinationRepository->getAll();
            return view('admin.vaccination_list',compact('vaccData'));
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/VaccinationList :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function addVaccination(VaccinationRequest $request)
    {
        try {
         
           return $this->vaccinationServices->addVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/addVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteVaccination(Request $request)
    {
        try {
           return $this->vaccinationServices->deleteVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/deleteVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateVaccination(VaccinationRequest $request)
    {
        try {
           return $this->vaccinationServices->updateVaccination($request);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/updateVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getVaccination(Request $request)
    {
        try {
           return$this->vaccinationRepository->get(['id'=>$request->id]);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/getVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    

  

}
