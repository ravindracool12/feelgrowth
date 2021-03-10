<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransferRepository;
use App\Repositories\MemberRepository;

class TransferController extends Controller
{
    /**
     * The TransferRepository instance.
     *
     * @var \App\Repositories\TransferRepository
     */
    protected $TransferRepository;

    /**
     * The MemberRepository instance.
     *
     * @var \App\Repositories\MemberRepository
     */
    protected $MemberRepository;

    /**
     * Create a new TransferController instance.
     *
     * @param \App\Repositories\TransferRepository $TransferRepository
     * @return void
     */
    public function __construct(
        TransferRepository $TransferRepository,
        MemberRepository $MemberRepository
    ) {
        $this->TransferRepository = $TransferRepository;
        $this->MemberRepository = $MemberRepository;
        $this->middleware('member');
    }

    /**
     * Transfer register, promo, or cash point
     * @return json
     */
    public function postTransferPoint () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        if (!$toMember = $this->MemberRepository->findByUsername(trim($data['to_username']))) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.memberNotFound')
            ]);
        }
        
        try {
            $this->TransferRepository->makeTransfer($member, $toMember, $data['amount'], $data['type']);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        \Cache::forget('member.' . $user->id);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  \Lang::get('message.transferSuccess')
        ]);
    }

    /**
     * Transfer list - DataTable
     * @return [type] [description]
     */
    public function getList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->TransferRepository->getList($member);
    }
}
