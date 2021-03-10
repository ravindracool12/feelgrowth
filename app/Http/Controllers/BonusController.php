<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\BonusRepository;

class BonusController extends Controller
{
    /**
     * The BonusRepository instance.
     *
     * @var \App\Repositories\BonusRepository
     */
    protected $BonusRepository;

    /**
     * Create a new BonusController instance.
     *
     * @param \App\Repositories\BonusRepository $BonusRepository
     * @return void
     */
    public function __construct(BonusRepository $BonusRepository) {
        $this->BonusRepository = $BonusRepository;
        $this->middleware('member');
    }

    /**
     * Direct bonus list - DataTable
     * @return object
     */
    public function getDirectList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->BonusRepository->directList($member);
    }

    /**
     * Group bonus list - DataTable
     * @return object
     */
    public function getGroupList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->BonusRepository->groupList($member);
    }

    /**
     * Pending Group bonus list - DataTable
     * @return object
     */
    public function getGroupPendingList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->BonusRepository->pendingGroupList($member);
    }

    /**
     * Override bonus list - DataTable
     * @return object
     */
    public function getOverrideList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->BonusRepository->overrideList($member);
    }

    /**
     * Pairing bonus list - DataTable
     * @return object
     */
    public function getPairingList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->BonusRepository->pairingList($member);
    }
}
