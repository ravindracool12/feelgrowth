<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\SharesRepository;

class SharesController extends Controller
{
	/**
     * The SharesRepository instance.
     *
     * @var \App\Repositories\SharesRepository
     */
    protected $SharesRepository;

    public function __construct(
        SharesRepository $SharesRepository
    ) {
        $this->middleware('admin');
        $this->SharesRepository = $SharesRepository;
    }

    /**
     * Shares Freeze List - DataTable
     * @return object
     */
    public function getSharesFreezeList () {
        return $this->SharesRepository->adminFreezeList();
    }

    /**
     * Shares Sell List - DataTable
     * @return object
     */
    public function getSharesSellList () {
        return $this->SharesRepository->adminSellList();
    }

    /**
     * Shares Buy List - DataTable
     * @return object
     */
    public function getSharesBuyList () {
        return $this->SharesRepository->adminBuyList();
    }

    /**
     * Update shares settings
     * @return json
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');

        \DB::table('Shares_Centre')->where('id', $id)->update([
            'minimum_price' =>  $data['minimum_price'],
            'current_price' =>  $data['current_price'],
            'raise_by' =>  $data['raise_by'],
            // 'current_accumulate' =>  $data['current_accumulate'],
            'raise_limit' =>  $data['raise_limit'],
            'always_company'    =>  isset($data['always_company']) ? 1 : 0
        ]);

        \Cache::forget('shares.state');

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Shares settings updated.'
        ]);
    }

    /**
     * Admin sell shares
     * @return json
     */
    public function sell () {
        $data = \Input::get('data');
        
        try {
            $this->SharesRepository->adminSellShares($data['quantity'], $data['price']);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Shares sales successful.'
        ]);
    }

    /**
     * Remove Queued Shares
     * @return json
     */
    public function removeQueue () {
        try {
            $this->SharesRepository->removeQueueShares();
        }  catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'All queued shares removed.'
        ]);
    }

    /**
     * Split shares
     * @return json
     */
    public function split () {
        $data = \Input::get('data');

        try {
            $this->SharesRepository->splitShares($data['split_to'], $data['split_by']);
        }  catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Shares split successful.'
        ]);
    }

    /**
     * Update freeze shares amount
     * @return json
     */
    public function updateFreeze ($id) {
        $data = \Input::get('data');
        $model = new \App\Models\MemberFreezeShares;
        if (!$model = $model->where('id', trim($id))->first()) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found.'
            ]);
        }

        $model->amount = $data['amount'];
        $model->created_at = $data['created_at'];
        $model->active_date = $data['active_date'];
        $model->save();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares amount updated.'
        ]);
    }

    /**
     * Update sell shares amount
     * @return json
     */
    public function updateSell ($id) {
        $data = \Input::get('data');
        $model = new \App\Models\SharesSell;
        if (!$model = $model->where('id', trim($id))->first()) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found.'
            ]);
        }

        $model->amount = $data['amount'];
        $model->amount_left = $data['amount_left'];
        $model->total = $data['total'];
        $model->share_price = $data['share_price'];
        $model->created_at = $data['created_at'];
        $model->save();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares sell updated.'
        ]);
    }

    /**
     * Update buy shares amount
     * @return json
     */
    public function updateBuy ($id) {
        $data = \Input::get('data');
        $model = new \App\Models\SharesBuy;
        if (!$model = $model->where('id', trim($id))->first()) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found.'
            ]);
        }

        $model->amount = $data['amount'];
        $model->amount_left = $data['amount_left'];
        $model->total = $data['total'];
        $model->share_price = $data['share_price'];
        $model->created_at = $data['created_at'];
        $model->save();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares amount updated.'
        ]);
    }

    /**
     * Unlock freeze shares
     * @return json
     */
    public function unlock ($id) {
        $model = new \App\Models\MemberFreezeShares;
        if (!$model = $model->where('id', trim($id))->first()) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Data not found.'
            ]);
        }

        if ($model->has_process) {
            return \Response::json([
                'type' => 'information',
                'message' => 'Shares already unlocked.'
            ]);
        }

        if (!$member = $model->member) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Member not found.'
            ]);
        }

        if (!$shares = $member->shares) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Shares not found.'
            ]);
        }

        $shares->amount += $model->amount;
        $model->has_process = true;
        $shares->save();
        $model->save();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares unlocked.'
        ]);
    }

    /**
     * Remove Freeze Shares
     * @return [type] [description]
     */
    public function postSellDelete ($id) {
        $model = new \App\Models\SharesSell;
        $model->where('id', trim($id))->delete();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares data removed.'
        ]);
    }

    /**
     * Remove Freeze Shares
     * @return [type] [description]
     */
    public function postBuyDelete ($id) {
        $model = new \App\Models\SharesBuy;
        $model->where('id', trim($id))->delete();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares data removed.'
        ]);
    }

    /**
     * Remove Freeze Shares
     * @return [type] [description]
     */
    public function postFreezeDelete ($id) {
        $model = new \App\Models\MemberFreezeShares;
        $model->where('id', trim($id))->delete();

        return \Response::json([
            'type' => 'success',
            'message' => 'Shares data removed.'
        ]);
    }
}
