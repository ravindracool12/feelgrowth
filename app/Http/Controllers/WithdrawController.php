<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\WithdrawRepository;

class WithdrawController extends Controller
{
    /**
     * The WithdrawRepository instance.
     *
     * @var \App\Repositories\WithdrawRepository
     */
    protected $WithdrawRepository;

    /**
     * Create a new WithdrawController instance.
     *
     * @param \App\Repositories\WithdrawRepository $WithdrawRepository
     * @return void
     */
    public function __construct(WithdrawRepository $WithdrawRepository) {
        $this->WithdrawRepository = $WithdrawRepository;
        $this->middleware('member');
    }

    /**
     * Member Withdraw Cash Point
     * @return [type] [description]
     */
    public function postMakeWithdraw () {
        $now = Carbon::now();
        $date = $now->day;

        if ($date != '10' && $date != '25') {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.wdDateError')
            ]);
        }

        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (is_null($member->detail->bank_name) || is_null($member->detail->bank_account_holder) || is_null($member->detail->bank_account_number)) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.bankError')
            ]);
        }

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        try {
            $this->WithdrawRepository->makeWithdraw($member, $data['amount']);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        \Cache::forget('member.' . $user->id);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  \Lang::get('message.withdrawSuccess')
        ]);
    }

    /**
     * Withdraw list - DataTable
     * @return [type] [description]
     */
    public function getList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->WithdrawRepository->getList($member);
    }
}
