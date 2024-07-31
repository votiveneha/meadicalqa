<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;


class NurseRepository extends BaseRepository{

    protected $model;
    protected $cache;

    public function __construct(User $model, Cache $cache){
        $this->model = $model;
        parent::__construct($model, $cache);
    }
    public function getIncomingNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getIncomingNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getcompleteprofileNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '4'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getcompleteprofileNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getInProgressprofileNurseList(){
        try {
            return $this->model->where(['type'=>'1','emailVerified'=>'1','user_stage' => '5'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getInProgressprofileNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function getCustomerList(){
        try {
            return $this->model->where(['type'=>'0','user_stage' => '1'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getIncomingNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalIncomingNurse(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '1'])->count();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.totalIncomingNurse(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getActiveNurseList(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->orderBy('id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getActiveNurseList(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function totalActiveNurse(){
        try {
            return $this->model->where(['type'=>'1','user_stage' => '2'])->count();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.totalActiveNurse(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updateData($byWhere,$updateData){
        try {
             return $this->model->where($byWhere)->update($updateData);
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.updateData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deleteData($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.deleteData(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getOneUser($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in NurseRepository.getOneUser(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}
