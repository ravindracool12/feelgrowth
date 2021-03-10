<?php

namespace App\Repositories;

use App\Models\Transfer;
use Yajra\Datatables\Facades\Datatables;

class TransferRepository extends BaseRepository
{
    protected $model;
    protected $allowedFields = [];
    protected $booleanFields = [];

    public function __construct() {
        $this->model = new Transfer;
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
     * All Transfers - DataTable admin
     * @param  boolean $table
     * @return object
     */
    public function findAll ($table=false) {
        if (!$table) return $this->model->all();
        else {
            return Datatables::eloquent($this->model->query())
                ->addColumn('action', function ($model) {
                    return view('back.transfer.action')->with('model', $model);
                })
                ->editColumn('amount', function ($model) {
                    return number_format($model->amount, 2);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    /**
     * Transfer List - DataTable member
     * @param  App\Models\Member $member [description]
     * @return object
     */
    public function getList ($member) {
        return Datatables::eloquent($this->model->where('from_member_id', $member->id)->orWhere('to_member_id', $member->id))
            ->editColumn('amount', function ($model) use ($member) {
                $number = number_format($model->amount, 2);
                if ($model->from_member_id == $member->id) {
                    return '<span style="color:#f00;">-' . $number . '</span>';
                } else if ($model->to_member_id == $member->id) {
                    return '<span style="color:#369611;">+' . $number . '</span>';
                }
            })
            ->rawColumns(['amount'])
            ->make(true);
    }

    /**
     * Make the point transfer
     * @param  App\Models\Member $from
     * @param  App\Models\Member $to
     * @param  float $amount
     * @param  string $type
     * @return boolean
     */
    public function makeTransfer ($from, $to, $amount, $type) {
        if (!$this->checkCanTransfer($from, $to)) {
            throw new \Exception(\Lang::get('error.transferMemberError'), 1);
            return false;
        }

        if ($amount % 10 != 0) {
            throw new \Exception(\Lang::get('error.transferAmountError'), 1);
            return false;
        }

        $walletFrom = $from->wallet;
        $walletTo = $to->wallet;
        $amount = (float) $amount;

        switch ($type) {
            case 'cash':
                if ($walletFrom->lock_cash) {
                    throw new \Exception(\Lang::get('error.cashWalletLock'), 1);
                    return false;
                }
                if ($walletFrom->cash_point < $amount) {
                    throw new \Exception(\Lang::get('error.cashPointNotEnough'), 1);
                    return false;
                }
                if ($from->id != $to->id) {
                    $walletFrom->cash_point -= $amount;
                    $walletTo->promotion_point += $amount;
                    $walletFrom->save();
                    $walletTo->save();
                } else {
                    $walletFrom->cash_point -= $amount;
                    $walletFrom->promotion_point += $amount;
                    $walletFrom->save();
                }
                break;

            case 'promotion':
                if ($walletFrom->lock_promotion) {
                    throw new \Exception(\Lang::get('error.promotionWalletLock'), 1);
                    return false;
                }
                if ($walletFrom->promotion_point < $amount) {
                    throw new \Exception(\Lang::get('error.promotionPointNotEnough'), 1);
                    return false;
                }
                if ($from->id != $to->id) {
                    $walletFrom->promotion_point -= $amount;
                    $walletTo->promotion_point += $amount;
                    $walletFrom->save();
                    $walletTo->save();
                }
                break;

            case 'register':
                if ($walletFrom->lock_register) {
                    throw new \Exception(\Lang::get('error.registerWalletLock'), 1);
                    return false;
                }
                if ($walletFrom->register_point < $amount) {
                    throw new \Exception(\Lang::get('error.registerPointNotEnough'), 1);
                    return false;
                }
                if ($from->id != $to->id) {
                    $walletFrom->register_point -= $amount;
                    $walletTo->register_point += $amount;
                    $walletFrom->save();
                    $walletTo->save();
                }
                break;
            
            default:
                throw new \Exception(\Lang::get('error.transferTypeError'), 1);
                break;
        }

        $this->saveModel(new $this->model, [
            'from_member_id' =>  $from->id,
            'to_member_id' =>  $to->id,
            'from_username' => $from->username,
            'to_username' => $to->username,
            'type'  =>  $type,
            'amount'    =>  $amount
        ]);

        return true;
    }

    /**
     * Check if can transfer to target member
     * @param  App\Models\Member $from
     * @param  App\Models\Member $to
     * @return boolean
     */
    public function checkCanTransfer ($from, $to) {
        if ($from->id == $to->id) return true;
        // if ($from->level >= $to->level) return false;

        $left = explode(',', $from->left_children);
        $right = explode(',', $from->right_children);
        if (in_array($to->id, $left) || in_array($to->id, $right)) {
            return true;
        }

        $left = explode(',', $to->left_children);
        $right = explode(',', $to->right_children);

        if (in_array($from->id, $left) || in_array($from->id, $right)) {
            return true;
        }

        return false;
    }

}