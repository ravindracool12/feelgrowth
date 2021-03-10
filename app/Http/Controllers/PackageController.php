<?php

namespace App\Http\Controllers;

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

    /**
     * Create a new PackageController instance.
     *
     * @param \App\Repositories\PackageRepository $PackageRepository
     * @return void
     */
    public function __construct(PackageRepository $PackageRepository) {
        $this->PackageRepository = $PackageRepository;
        // $this->middleware('');
    }
}
