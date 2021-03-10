<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\CoinRepository;
use App\Services\BlockCypher;

class CoinController extends Controller
{
    public function __construct(CoinRepository $CoinRepository) {
        $this->CoinRepository = $CoinRepository;
        $this->middleware('admin');
    }

    /**
     * Get MEMBER Wallet List
     * @return json
     */
    public function getWalletList () {
        return $this->CoinRepository->getAdminWalletList();
    }

    /**
     * Get WALLET detail
     * @param string $id
     * @return html
     */
    public function getWalletDetail ($id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findWalletById(trim($id))) {
            return redirect(route('admin.coin.list'))->with('flashMessage', [
                'class' => 'danger',
                'message' => 'Coin wallet not found.'
            ]);
        }

        return view('back.coin.walletDetail')->with('model', $model);
    }

    /**
     * Get WALLET ADDRESS detail
     * @param string $id
     * @return html
     */
    public function getAddressDetail ($id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findAddressById(trim($id))) {
            return '<div class="alert alert-danger">Cannot find address.</div>';
        }

        $wallet = $model->wallet;
        $service = new BlockCypher($wallet->coin_type);
        $address = json_decode($model->info);

        try {
            $detail = $service->getAddressDetail($address->address);
        } catch (\Exception $e) {
            return '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
        }
        
        return view('back.coin.addressDetail')->with('data', [
            'wallet' => $wallet,
            'model' => $model,
            'detail' => $detail
        ]);
    }

    /**
     * Get TRANSACTION MEMBER
     * @return json
     */
    public function getTransactionList () {
        return $this->CoinRepository->getAdminTransactionList();
    }

    /**
     * Get TRANSACTION Details
     * @param string $id
     * @return html
     */
    public function getTransactionDetail ($id) {
        if (!$model = $this->CoinRepository->findTransactionById(trim($id))) {
            return '<div class="alert alert-danger">Transaction not found.</div>';
        }

        $service = new BlockCypher($model->coin_type);

        try {
            $detail = $service->getTransactionDetail($model->hash_value);
        } catch (\Exception $e) {
            return '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
        }

        return view('back.coin.transactionDetail')->with('data', [
            'model' => $model,
            'detail' => $detail
        ]);
    }
}
