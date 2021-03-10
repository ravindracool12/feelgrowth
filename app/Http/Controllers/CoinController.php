<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CoinRepository;
use App\Services\BlockCypher;

class CoinController extends Controller
{
    /**
     * Create a new CoinController instance.
     *
     * @param \App\Repositories\CoinRepository $CoinRepository
     * @return void
     */
    public function __construct(CoinRepository $CoinRepository) {
        parent::__construct();
        $this->CoinRepository = $CoinRepository;
        $this->middleware('member');
    }

    /**
     * Get MEMBER Wallet List
     * @return json
     */
    public function getWalletList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->CoinRepository->getMemberWalletList($member);
    }

    /**
     * Get WALLET detail
     * @param string $id
     * @return html
     */
    public function getWalletDetail ($lang, $id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findWalletById(trim($id))) {
            return redirect(route('coin.list'))->with('flashMessage', [
                'class' => 'danger',
                'message' => \Lang::get('coin.walletNotFound')
            ]);
        }

        if ($model->member_id != $member->id) {
            return redirect(route('coin.list'))->with('flashMessage', [
                'class' => 'danger',
                'message' => \Lang::get('coin.walletOwnerError')
            ]);

            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletOwnerError')
            ]);
        }
        
        return view('front.coin.walletDetail')->with('model', $model);
    }

    /**
     * Get WALLET ADDRESS detail
     * @param string $id
     * @return html
     */
    public function getAddressDetail ($lang, $id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findAddressById(trim($id))) {
            return '<div class="alert alert-danger">' . \Lang::get('coin.addressNotFound') . '</div>';
        }

        $wallet = $model->wallet;

        if ($wallet->member_id != $member->id) {
            return '<div class="alert alert-danger">' . \Lang::get('coin.walletOwnerError') .'</div>';
        }

        $service = new BlockCypher($wallet->coin_type);

        $address = json_decode($model->info);

        try {
            $detail = $service->getAddressDetail($address->address);
        } catch (\Exception $e) {
            return '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
        }
        
        return view('front.coin.addressDetail')->with('data', [
            'wallet' => $wallet,
            'model' => $model,
            'detail' => $detail
        ]);
    }

    /**
     * Create WALLET
     * @return json
     */
    public function createWallet () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!isset($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        if (!$this->CoinRepository->checkType($data['coin_type'])) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.txError')
            ]);
        }

        if ($data['coin_type'] == 'eth') {
            $this->CoinRepository->createWallet($member, $data);
        } else {
            $service = new BlockCypher($data['coin_type']);

            try {
                $wallet = $service->generateNewWallet($data['wallet_name']);
            } catch (\Exception $e) { // wallet exists
                return \Response::json([
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }

            $this->CoinRepository->createWallet($member, $data);
        }

        return \Response::json([
            'type' => 'success',
            'message' => \Lang::get('coin.walletSuccess'),
            'redirect' => route('coin.list', ['lang' => \App::getLocale()])
        ]);
    }

    /**
     * Create ADDRESS based on WALLET
     * @return json
     */
    public function createAddress () {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findWalletById(trim(\Input::get('id')))) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletNotFound')
            ]);
        }

        if ($model->member_id != $member->id) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletOwnerError')
            ]);
        }

        $service = new BlockCypher($model->coin_type);

        // create address
        try {
            $address = $service->generateNewAddress();
        } catch (\Exception $e) {
            return \Response::json([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        if (!isset($address->address)) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.addressGenerateError')
            ]);
        }

        if ($model->coin_type != 'eth') {
            // add address to wallet
            try {
                $service->addAddressToWallet($model->wallet_name, [$address->address]);
            } catch (\Exception $e) {
                return \Response::json([
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        $this->CoinRepository->addAddressToWallet($model, $address);

        return \Response::json([
            'type' => 'success',
            'message' => \Lang::get('coin.addressSuccess')
        ]);
    }

    /**
     * Remove WALLET and ADDRESS
     * @return json
     */
    public function deleteWallet ($lang, $id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findWalletById(trim($id))) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletNotFound')
            ]);
        }

        if ($model->member_id != $member->id) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletOwnerError')
            ]);
        }

        if ($wallet->coin_type != 'eth') {
            $service = new BlockCypher($model->coin_type);
            // delete wallet
            try {
                $output = $service->deleteWallet($model->wallet_name);
            } catch (\Exception $e) {
                return \Response::json([
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        $model->delete();

        return \Response::json([
            'type' => 'success',
            'message' => \Lang::get('coin.walletRemove')
        ]);
    }

    /**
     * Get TRANSACTION MEMBER
     * @return json
     */
    public function getTransactionList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->CoinRepository->getMemberTransactionList($member);
    }

    /**
     * Get TRANSACTION Details
     * @param string $id
     * @return html
     */
    public function getTransactionDetail ($lang, $id) {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!$model = $this->CoinRepository->findTransactionById(trim($id))) {
            return '<div class="alert alert-danger">' . \Lang::get('coin.txError') .'</div>';
        }

        if ($model->member_id != $member->id) {
            return '<div class="alert alert-danger">' . \Lang::get('coin.txOwnerError') .'</div>';
        }

        $service = new BlockCypher($model->coin_type);

        try {
            $detail = $service->getTransactionDetail($model->hash_value);
        } catch (\Exception $e) {
            return '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
        }

        return view('front.coin.transactionDetail')->with('data', [
            'model' => $model,
            'detail' => $detail
        ]);
    }

    /**
     * Create TRANSACTION
     * @return json
     */
    public function createTransaction () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!isset($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        if (!$address = $this->CoinRepository->findAddressById(trim($data['from_address']))) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.txError')
            ]);
        }

        if (!$wallet = $address->wallet) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.txError')
            ]);
        }

        if ($wallet->member_id != $member->id) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.walletOwnerError')
            ]);
        }

        $service = new BlockCypher($wallet->coin_type);
        $addressInfo = json_decode($address->info);

        // check if fund is enough
        try {
            $detail = $service->getAddressDetail($addressInfo->address);
        } catch (\Exception $e) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.endpointError')
            ]);
        }

        // check for admin fee
        $adminCoin = config('misc.coin');
        if (!isset($adminCoin[$wallet->coin_type])) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.txError')
            ]);
        }
        $fee = ($adminCoin['fee'] / 100) * $data['amount'];
        $total = $data['amount'] + $fee;
        $currentBalance = $service->convertToBTC($detail->final_balance);
        if ($currentBalance < $total) {
            return \Response::json([
                'type' => 'error',
                'message' => \Lang::get('coin.fundNotEnough')
            ]);
        }

        // send transaction
        try {
            $memberTx = $service->createTx($addressInfo->address, $data['to_address'], (float) $data['amount'], $addressInfo->private);
            $adminTx = $service->createTx($addressInfo->address, $adminCoin[$wallet->coin_type], $fee, $addressInfo->private);
        } catch (\Exception $e) {
            return \Response::json([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        $memberTx = $memberTx->getTx();
        $adminTx = $adminTx->getTx();

        // save to database
        $this->CoinRepository->createTx([
            'coin_type' => $wallet->coin_type,
            'from_address' => $addressInfo->address,
            'to_address' => $data['to_address'],
            'hash_value' => $memberTx->getHash(),
            'is_admin' => false,
            'amount' => $data['amount'],
            'member_id' => $member->id,
            'username' => $member->username
        ]);

        $this->CoinRepository->createTx([
            'coin_type' => $wallet->coin_type,
            'from_address' => $addressInfo->address,
            'to_address' => $adminCoin[$wallet->coin_type],
            'hash_value' => $adminTx->getHash(),
            'is_admin' => true,
            'amount' => $fee,
            'member_id' => $member->id,
            'username' => $member->username
        ]);

        return \Response::json([
            'type' => 'success',
            'message' => \Lang::get('coin.txSuccess'),
            'redirect' => route('coin.transaction', ['lang' => \App::getLocale()])
        ]);
    }
}
