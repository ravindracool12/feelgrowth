<?php

namespace App\Repositories;

use App\Models\Coin\Transaction;
use App\Models\Coin\Wallet;
use App\Models\Coin\WalletAddress;
use Yajra\Datatables\Facades\Datatables;

class CoinRepository {
    protected $transactionModel, $walletModel, $addressModel;
    private $coinType = [
        'btc', 'ltc', 'doge', 'eth', 'bcy'
    ];

    public function __construct () {
        $this->transactionModel = new Transaction;
        $this->walletModel = new Wallet;
        $this->addressModel = new WalletAddress;
    }

    /**
     * Find ADDRESS by id
     * @param string $id
     * @return App\Models\Coin\Transaction
     */
    public function findAddressById ($id) {
        return $this->addressModel->where('id', $id)->first();
    }

    /**
     * Find TRANSACTION by id
     * @param string $id
     * @return App\Models\Coin\Transaction
     */
    public function findTransactionById ($id) {
        return $this->transactionModel->where('id', $id)->first();
    }

    /**
     * Find WALLET by id
     * @param string $id
     * @return App\Models\Coin\Wallet
     */
    public function findWalletById ($id) {
        return $this->walletModel->where('id', $id)->first();
    }

    /**
     * Check if coin type is valid
     * @param string $type
     * @return boolean
     */
    public function checkType ($type) {
        return in_array($type, $this->coinType);
    }

    /**
     * Create WALLET member
     * @param App\Models\Member $member
     * @param array $data
     * @return App\Models\Coin\Wallet
     */
    public function createWallet ($member, $data) {
        $model = new $this->walletModel;
        $model->member_id = $member->id;
        $model->coin_type = $data['coin_type'];
        $model->username = $member->username;
        $model->wallet_name = $data['wallet_name'];
        $model->save();
        return $model;
    }

    /**
     * Add WALLET address
     * @param App\Models\Wallet $wallet
     * @param json $addressInfo
     * @return App\Models\Coin\WalletAddress
     */
    public function addAddressToWallet ($wallet, $addressInfo) {
        $model = new $this->addressModel;
        $model->wallet_id = $wallet->id;
        $model->info = $addressInfo;
        $model->save();
        return $model;
    }

    /**
     * Get current MEMBER transaction list
     * @param App\Models\Member $member
     * @return json
     */
    public function getMemberTransactionList ($member) {
        return Datatables::eloquent($this->transactionModel->where('member_id', $member->id)->where('is_admin', false))
            ->editColumn('amount', function ($model) {
                return $model->amount . ' ' . strtoupper($model->coin_type);
            })
            ->editColumn('action', function ($model) {
                return view('front.coin.transactionAction')->with('model', $model);
            })
            ->make(true);
    }

    /**
     * Get ALL transaction list
     * @return json
     */
    public function getAdminTransactionList () {
        return Datatables::eloquent($this->transactionModel->query())
            ->editColumn('is_admin', function ($model) {
                if ($model->is_admin) return '<label class="label label-success">ADMIN FEE</label>';
                else return '<label class="label label-default">MEMBER TRANSACTION</label>';
            })
            ->editColumn('amount', function ($model) {
                return $model->amount . ' ' . strtoupper($model->coin_type);
            })
            ->editColumn('action', function ($model) {
                return view('back.coin.transactionAction')->with('model', $model);
            })
            ->rawColumns(['is_admin', 'action'])
            ->make(true);
    }

    /**
     * Get current MEMBER transaction list
     * @param App\Models\Member $member
     * @return json
     */
    public function getMemberWalletList ($member) {
        return Datatables::eloquent($this->walletModel->where('member_id', $member->id))
            ->editColumn('action', function ($model) {
                return view('front.coin.walletAction')->with('model', $model);
            })
            ->make(true);
    }

    /**
     * Get ALL transaction list
     * @return json
     */
    public function getAdminWalletList () {
        return Datatables::eloquent($this->walletModel->query())
            ->editColumn('action', function ($model) {
                return view('back.coin.walletAction')->with('model', $model);
            })
            ->make(true);
    }

    /**
     * Save transaction to database
     * @param array $data
     * @return \App\Models\Coin\Transaction
     */
    public function createTx ($data) {
        $model = new $this->transactionModel;
        foreach ($data as $k => $d) {
            $model->{$k} = $d;
        }
        $model->save();
        return $model;
    }
}
