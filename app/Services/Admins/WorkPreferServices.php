<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\WorkPreferencesRepository;

class WorkPreferServices
{
    protected $work_prefer_repository;

    public function __construct(WorkPreferencesRepository $work_prefer_repository)
    {
        $this->work_prefer_repository = $work_prefer_repository;
    }

     public function addWorkEnvironment($data)
    {
        try {
            $allData['env_name'] = $data['env_name'];
            $allData['sub_env_id'] = $data['sub_env_id'];
            $allData['sub_envp_id'] = $data['sub_envp_id'];
            $run = $this->work_prefer_repository->create($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteEnvironment($request)
    {
        try {
            $run = $this->work_prefer_repository->delete(['prefer_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateWorkEnvironment($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['env_name'] = $data['env_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->update(['prefer_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Work Environment'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addPosition($data)
    {
        try {
            $allData['position_name'] = $data['position_name'];
            $allData['subposition_id'] = $data['subposition_id'];
            
            $run = $this->work_prefer_repository->createPosition($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deletePosition($request)
    {
        try {
            $run = $this->work_prefer_repository->deletePosition(['position_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatePosition($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['position_name'] = $data['position_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->updatePosition(['position_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Position'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addWorkshift($data)
    {
        try {
            $allData['shift_name'] = $data['work_shift_name'];
            $allData['shift_id'] = $data['shift_id'];
            $allData['sub_shift_id'] = $data['sub_shift_id'];
            
            $run = $this->work_prefer_repository->createWorkShift($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteWorkshift($request)
    {
        try {
            $run = $this->work_prefer_repository->deleteWorkshift(['work_shift_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateWorkshift($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['shift_name'] = $data['work_shift_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->updateWorkShift(['work_shift_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Work shift preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function addBenefits($data)
    {
        try {
            $allData['benefits_name'] = $data['benefit_name'];
            $allData['subbenefit_id'] = $data['subbenefit_id'];
            
            $run = $this->work_prefer_repository->createBenefits($allData);
            
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Benefit preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in MembershipServices/addCountry(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteBenefits($request)
    {
        try {
            $run = $this->work_prefer_repository->deleteBenefits(['benefits_id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Benefit preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/deleteDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateBenefits($data)
    {
        //print_r($data['env_name']);die;
        try {

            $allData['benefits_name'] = $data['benefit_name'];
            
            
            $id = $data['id'];
            $run= $this->work_prefer_repository->updateBenefits(['benefits_id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Benefit preferences'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in DegreeServices/updateDegree(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

}    