<?php

namespace App\Repository\Eloquent;

use App\Models\WorkPreferModel;
use App\Models\PositionModel;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\Log;
use DB;

class WorkPreferencesRepository extends BaseRepository{

    protected $model;
    protected $position_model;
    
    protected $cache;

    public function __construct(WorkPreferModel $model,PositionModel $position_model, Cache $cache ){
        $this->model = $model;
        $this->position_model = $position_model;
        parent::__construct($model, $cache);
    }

    public function create($data){
        
        try {
            return $this->model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function get($byWhere){
        try {
            return $this->model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAll($byWhere){
        
        try {
            
            return $this->model->where($byWhere)->orderBy('prefer_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function delete($byWhere){
        try {
            return $this->model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function update($byWhere,$Data){
        try {
            
            return DB::table("work_enviornment_preferences")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }

    public function createPosition($data){
        
        try {
            return $this->position_model->insert($data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.create(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getPosition($byWhere){
        try {
            return $this->position_model->where($byWhere)->first();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.get(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function getAllPositions($byWhere){
        
        try {
            
            return $this->position_model->where($byWhere)->orderBy('position_id', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.getAll(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function deletePosition($byWhere){
        try {
            return $this->position_model->where($byWhere)->delete();
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.delete(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
    public function updatePosition($byWhere,$Data){
        try {
            
            return DB::table("employee_positions")->where($byWhere)->update($Data);
        } catch(\Exception $e){
            Log::error("Error in DegreeRepository.update(): " . $e->getMessage());
            return response()->json(['status' => '0', 'message' => __('message.statusZero')]);
        }
    }
}