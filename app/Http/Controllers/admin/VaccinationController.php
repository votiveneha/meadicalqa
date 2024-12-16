<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\VaccinationRequest;
use App\Services\Admins\VaccinationServices;
use App\Services\Admins\EvidenceServices;
use App\Repository\Eloquent\VaccinationRepository;
use App\Repository\Eloquent\EvidenceRepository;

class VaccinationController extends Controller
{
    protected $vaccinationServices;
    protected $evidenceServices;
    protected $vaccinationRepository;
    protected $evidenceRepository;

    public function __construct(
        VaccinationServices $vaccinationServices,
        VaccinationRepository $vaccinationRepository,
        EvidenceServices $evidenceServices,
        EvidenceRepository $evidenceRepository
    ) {
        $this->vaccinationServices = $vaccinationServices;
        $this->vaccinationRepository = $vaccinationRepository;
        $this->evidenceServices = $evidenceServices;
        $this->evidenceRepository = $evidenceRepository;
    }

    // this is Degree  data in database
    public function VaccinationList(Request $request)
    {
        try {
            $vaccData  = $this->vaccinationRepository->getAll();
            return view('admin.vaccination_list', compact('vaccData'));
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
            return $this->vaccinationRepository->get(['id' => $request->id]);
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/getVaccination :' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    // this is Evidence  data in database
    public function EvidenceList(Request $request)
    {
        try {
            $eviData  = $this->evidenceRepository->getAll();
            return view('admin.evidence_list', compact('eviData'));
        } catch (\Exception $e) {
            log::error('Error in VaccinationController/EvidenceList:' . $e->getMessage() . 'in line' . $e->getLine());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
