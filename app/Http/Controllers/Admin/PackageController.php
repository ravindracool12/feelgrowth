<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\PackageRepository;

class PackageController extends Controller
{
	/**
     * The PackageRepository instance.
     *
     * @var \App\Repositories\PackageRepository
     */
    protected $PackageRepository;

    public function __construct(
        PackageRepository $PackageRepository
    ) {
        $this->middleware('admin');
        $this->PackageRepository = $PackageRepository;
    }

    /**
     * Update package settings
     * @return [type] [description]
     */
    public function postUpdate ($id) {
        if (!$model = $this->PackageRepository->findById(trim($id))) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  'Package not found.'
            ]);
        }

        $data = \Input::get('data');
        $this->PackageRepository->update($model, $data);
        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Package updated.'
        ]);
    }
}
