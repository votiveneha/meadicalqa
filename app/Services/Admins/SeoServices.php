<?php
namespace App\Services\Admins;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repository\Eloquent\SeoRepository;

class SeoServices
{
    protected $SeoRepository;

    public function __construct(SeoRepository $SeoRepository)
    {
        $this->SeoRepository = $SeoRepository;
    }

    // Seo data in database

     public function addSeo($data)
    {
        try {
             $allData['meta_title'] = $data['meta_title'];
             $allData['meta_des'] = $data['meta_desc'];
             $allData['status'] = $data['status'];
             if ($data['image']) {
            $seo_image = time() . '.' . $data['image']->extension();

            if ($data['image']->move(public_path('/assets/admin/seo/'), $seo_image)) {
                $allData['image'] = '/assets/admin/seo/' . $seo_image;
            }
           }
            $run = $this->SeoRepository->create($allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusOne', ['parameter' => 'Page Data'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SeoServices/addTraining(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteTraining($request)
    {
        try {
            $run = $this->SeoRepository->delete(['id'=>$request->id]);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusThree', ['parameter' => 'Training'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SeoServices/deleteTraining(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateTraining($data)
    {
        try {

            $allData['name'] = $data['training'];
            $id = $data['id'];
            $run= $this->SeoRepository->update(['id' => $id], $allData);
            if ($run) {
                return response()->json(['status' => '2', 'message' => __('message.statusTwo', ['parameter' => 'Training'])]);
            } else {
                return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
            }
        } catch (\Exception $e) {
            Log::error('Error in SeoServices/updateTraining(): ' . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

 

        
}
