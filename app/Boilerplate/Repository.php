<?php

namespace App\Repositories;

use App\Models\Sample;

class SampleRepository extends BaseRepository
{
    protected $model;
    protected $allowedFields = [];
    protected $booleanFields = [];

    public function __construct() {
        $this->model = new Sample;
    }

    protected function saveModel($model, $data) {
        foreach ($data as $k=>$d) {
            $model->{$k} = $d;
        }
        $model->save();
        return $model;
    }

    public function store($data) {
        $model = $this->saveModel(new $this->model, $data);
        return $model;
    }

    public function update($model, $data) {
        $model = $this->saveModel($model, $data);
        return $model;
    }

    public function getAllowedFields () {
        return $this->allowedFields;
    }

    public function getBooleanFields () {
        return $this->booleanFields;
    }

    public function findById ($id) {
        return $this->model->where('id', $id)->first();
    }

}