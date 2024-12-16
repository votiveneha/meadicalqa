<?php

namespace App\Services\Admins;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\EvidenceRepository;

class EvidenceServices
{
    protected $evidenceRepository;

    public function __construct(EvidenceRepository $evidenceRepository)
    {
        $this->evidenceRepository = $evidenceRepository;
    }

    // degree data in database
    public function addVaccination($data)
    {
        try {
            $allData['name'] = $data['vaccination'];
            $run = $this->evidenceRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Vaccination'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in VaccinationServices/addVaccination(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteVaccination($request)
    {
        try {
            $run = $this->evidenceRepository->delete(['id' => $request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Vaccination'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in VaccinationServices/deleteVaccination(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateVaccination($data)
    {
        try {

            $allData['name'] = $data['vaccination'];
            $id = $data['id'];
            $run = $this->evidenceRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Vaccination'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in VaccinationServices/updateVaccination(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
