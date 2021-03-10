<?php

namespace App\Repositories;

use App\Models\Withdraw;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;

class WithdrawRepository extends BaseRepository
{
    protected $model, $adminFee;
    protected $allowedFields = [];
    protected $booleanFields = [];

    public function __construct() {
        $this->model = new Withdraw;
        $this->adminFee = config('misc.withdrawAdminFee');
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
     * All Withdraws - DataTable
     * @param  boolean $table
     * @return object
     */
    public function findAll ($table=false) {
        if (!$table) return $this->model->all();
        else {
            return Datatables::eloquent($this->model->query())
                ->addColumn('action', function ($model) {
                    return view('back.withdraw.action')->with('model', $model);
                })
                ->editColumn('status', function ($model) {
                    if ($model->status == 'done') return '<label class="label label-success">DONE</label>';
                    elseif ($model->status == 'reject') return '<label class="label label-danger">REJECT</label>';
                    else return '<label class="label label-default">PROCESS</label>';
                })
                ->editColumn('admin', function ($model) {
                    return number_format($model->admin, 2);
                })
                ->editColumn('amount', function ($model) {
                    return number_format($model->amount, 2);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Make Withdraw - Member
     * @param  App\Models\Member $member [description]
     * @param  decimal $amount [description]
     * @return [type]         [description]
     */
    public function makeWithdraw ($member, $amount) {
        if ($amount < 300 || ($amount % 100) != 0) {
            throw new \Exception(\Lang::get('error.withdrawAmountError'), 1);
            return false;
        }
        $wallet = $member->wallet;
        if ($wallet->lock_cash) {
            throw new \Exception(\Lang::get('error.cashWalletLock'), 1);
            return false;
        }
        $adminFee = ($this->adminFee / 100) * $amount;
        $wdAmount = $amount + $adminFee;

        if ($wdAmount > $wallet->cash_point) {
            throw new \Exception(\Lang::get('error.cashNotEnough'), 1);
            return false;
        } 

        $this->saveModel($this->model, [
            'member_id' =>  $member->id,
            'username'  =>  $member->username,
            'amount'    =>  $wdAmount,
            'admin'     =>  $adminFee,
            'status'    =>  'process'
        ]);

        $wallet->cash_point -= $wdAmount;
        $wallet->save();
        return true;
    }

    /**
     * Withdraw List - DataTable
     * @param  App\Models\Member $member [description]
     * @return [type]         [description]
     */
    public function getList ($member) {
        return Datatables::eloquent($this->model->where('member_id', $member->id))
            ->editColumn('status', function ($model) {
                if ($model->status == 'done') return '<label class="label label-success">' . \Lang::get('common.status.done') . '</label>';
                elseif ($model->status == 'reject') return '<label class="label label-danger">' . \Lang::get('common.status.reject') . '</label>';
                else return '<label class="label label-default">' . \Lang::get('common.status.process') . '</label>';
            })
            ->editColumn('admin', function ($model) {
                return number_format($model->admin, 2);
            })
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 2);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

}