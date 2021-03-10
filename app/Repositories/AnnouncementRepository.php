<?php

namespace App\Repositories;

use App\Models\Announcement;
use Yajra\Datatables\Facades\Datatables;

class AnnouncementRepository extends BaseRepository
{
    protected $model;
    protected $allowedFields = [];
    protected $booleanFields = [];

    public function __construct() {
        $this->model = new Announcement;
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

    /**
     * Datatable List - Member
     * @return [type] [description]
     */
    public function getList () {
        return Datatables::eloquent($this->model->query())
                ->addColumn('action', function ($model) {
                    return view('front.announcement.action')->with('model', $model);
                })
                ->editColumn('created_at', function ($model) {
                    return $model->created_at->format('Y-m-d H:i A');
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Datatable List - Admin
     * @return [type] [description]
     */
    public function getAdminList () {
        return Datatables::eloquent($this->model->query())
                ->addColumn('action', function ($model) {
                    return view('back.announcement.action')->with('model', $model);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

}