<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\SharesBuy;
use App\Models\SharesSell;
use App\Repositories\MemberRepository;
use Yajra\Datatables\Facades\Datatables;

class SharesRepository extends BaseRepository
{
    protected $model;
    protected $allowedFields = [];
    protected $booleanFields = [];
    private $sellSharesValue, $sellRange;

    public function __construct() {
        $this->modelBuy = new SharesBuy;
        $this->modelSell = new SharesSell;
        $this->sellSharesValue = config('misc.shares.sellValue');
        $this->sellRange = config('misc.shares.sellRange');
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
     * Get Current Shares State
     * @return object
     */
    public function getCurrentShareState () {
        $shares = \Cache::remember('shares.state', 60, function () {
            return \DB::table('Shares_Centre')->first();
        });
        return $shares;
    }

    /**
     * Get today sales
     * @param  boolean $count [as total or as object]
     * @return object
     */
    public function getTodaySales ($count=false) {
        return $count ? $this->modelSell->whereDate('created_at', \DB::raw('CURDATE()'))->sum('amount') : $this->modelSell->whereDate('created_at', \DB::raw('CURDATE()'))->get();
    }

    /**
     * Get member sales - grouped by price
     * @param float $min
     * @param float max
     * @return object
     */
    public function getSalesByMember ($min, $max) {
        return $this->modelSell
            ->where('has_process', 0)
            ->where('share_price', '>=', $min)
            ->where('share_price', '<=', $max)
            ->selectRaw('share_price as price, sum(amount) as amount')
            ->groupBy('share_price')
            ->get();
    }

    /**
     * Check if member can sell shares
     * @param  App\Models\Member
     * @param  App\Models\MemberShares $shares
     * @param  integer $quantity
     * @return boolean
     */
    public function checkCanSell ($member, $shares, $quantity) {
        if ($shares->current_sales >= $shares->max_share_sale) return false;
        $today = Carbon::now()->format('Y-m-d');
        $sales = $this->modelSell->where('member_id', $member->id)->where('created_at', '>=', $today . ' 00:00:00')->get();

        $total = 0;
        if (count($sales) > 0) {
            foreach ($sales as $sale) {
                $total += $sale->amount;
            }
        }

        if ($total >= $shares->share_limit) return false;
        $sales = $this->modelSell->where('member_id', $member->id)->where('has_process', 0)->sum('total');
        if ($sales >= $member->package_amount) return false;
        return true;
    }

    /**
     * Get AVAILABLE shares TO BUY
     * @param  $orderBy [optional]
     * @param  $sort [optional]
     * @return [type] [description]
     */
    public function getAvailableShares($orderBy=null, $sort=null) {
        $state = $this->getCurrentShareState();

        if ($state->always_company) {
            $model = $this->modelSell->where('has_process', 0)->where('is_admin', 1);
        } else {
            $model = $this->modelSell->where('has_process', 0);
        }

        if (!is_null($orderBy) && !is_null($sort)) {
            $model = $model->orderBy($orderBy, $sort);
        }
        return $model->get();
    }

    /**
     * Price list available when selling shares
     * @return array
     */
    public function getAvailableSellPrice () {
        $data = $this
                ->modelBuy
                ->selectRaw('share_price as price')
                ->where('has_process', 0);

        $data = $data->groupBy('share_price')->get();
        return $data->toArray();
    }

    /**
     * Price list available when buying shares
     * @return array
     */
    public function getAvailableBuyPrice () {
        $data = $this
                ->modelSell
                ->selectRaw('share_price as price')
                ->where('has_process', 0);
        $data = $data->groupBy('share_price')->get();
        return $data->toArray();
    }

    /**
     * Get LOWEST or HIGHEST shares selling price
     * @param  string $type ['low' or 'high' | REQUIRED]
     * @return float
     */
    public function getSellingPrice ($type) {
        if ($type != 'low' && $type != 'high') return 0;
        $model = $this->modelSell->where('has_process', 0);
        if ($type == 'low') return $model->min('shares_price');
        elseif ($type == 'high') return $model->max('shares_price');
    }

    /**
     * Substract sell shares amount left
     * @param  integer $quantity
     * @return boolean
     */
    public function processSellShares ($quantity) {
        $state = $this->getCurrentShareState();
        $models = $this->modelSell->where('has_process', 0);

        if ($state->always_company) {
            $models = $models->where('is_admin', 1);
        }

        $models = $models->orderBy('created_at', 'asc')->orderBy('is_admin', 'desc')->get();

        foreach ($models as $model) {
            $amount = $model->amount;
            $model->amount_left -= $quantity;
            if ($model->amount_left <= 0) {
                $model->amount_left = 0;
                $model->has_process = 1;
            }
            if (!$model->is_admin) $this->processSalesShares($model, $quantity);
            $model->save();
            $quantity -= $amount;
            if ($quantity <= 0) break;
        }

        return true;
    }

    /**
     * Process part of the shares sold
     * @param App\Models\ShareSell $share [description]
     * @param integer $quantity [description]
     * @return boolean [description]
     */
    public function processSalesShares ($share, $quantity) {
        if ($quantity <= 0) return false;
        if (!$member = $share->member) return false;
        $amount = $quantity * $share->share_price;
        $values = $this->sellSharesValue;

        $wallet = $member->wallet;
        $cash = ($values['cash'] / 100) * $amount;
        $md = ($values['point'] / 100) * $amount;
        $wallet->cash_point += $cash;
        $wallet->md_point += $md;

        // repurchase shares
        $buyBackAmount = (float) ($values['buyBack'] / 100) * $amount;

        // record sales
        \DB::table('Shares_Sell_Statement')->insert([
            'member_id' => $member->id,
            'sell_id' => $share->id,
            'amount' => $quantity,
            'cash_point' => $cash,
            'purchase_point' => $buyBackAmount,
            'md_point' => $md,
            'share_price' => $share->share_price,
            'admin_fee' => ($values['fee'] / 100) * $amount,
            'status' => 'sold',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $left = $this->repurchaseSell($member, $buyBackAmount, $wallet);
        if (!$left) {
            $wallet->purchase_point += $buyBackAmount;
        } else {
            $wallet->purchase_point += $left;
        }

        $wallet->save();
        // $this->accumulateSharesState(null, $quantity);
        return true;
    }

    /**
     * Buy Shares (Manual)
     * @param  App\Models\Member $member
     * @param  integer $quantity [Amount of shares in unit]
     * @param  decimal $price [Selected price to buy]
     * @return boolean
     */
    public function buyShares ($member, $quantity, $price) {
        $available = $this->getAvailableBuyPrice();
        $found = false;
        if ($quantity%10 != 0) {
            throw new \Exception(\Lang::get('error.sharesQuantityError'), 1);
            return false;
        }

        foreach ($available as $p) {
            if ($p['price'] == $price) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            throw new \Exception(\Lang::get('error.priceNotFound'), 1);
            return false;
        }

        if (!$wallet = $member->wallet) {
            throw new \Exception(\Lang::get('error.walletNotFound'), 1);
            return false;
        }

        $state = $this->getCurrentShareState();
        $amount = $quantity * $price;

        if ($amount > $wallet->purchase_point) {
            throw new \Exception(\Lang::get('error.purchasePointNotEnough'), 1);
            return false;
        }

        if (!$this->processSellShares($quantity)) {
            throw new \Exception(\Lang::get('error.buySharesProcessError'), 1);
            return false;
        }

        // add buy data
        $this->saveModel($this->modelBuy, [
            'member_id' =>  $member->id,
            'amount'    =>  $quantity,
            'amount_left'   =>  $quantity,
            'share_price'   =>  $price,
            'total'     =>  $amount,
        ]);

        // add freeze shares data
        \DB::table('Member_Freeze_Shares')->insert([
            'member_id' =>  $member->id,
            'amount'    =>  $quantity,
            'active_date'   =>  Carbon::now()->addDays(15),
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);

        // update wallet
        $wallet->purchase_point -= $amount;
        $wallet->save();

        $this->accumulateSharesState(null, $quantity);

        return true;
    }

    /**
     * Auto Repurchase - When Selling Shares
     * @param  App\Models\Member $member
     * @param  float $amount [amount, NOT quantity]
     * @param  object $wallet [optional]
     * @return boolean
     */
    public function repurchaseSell ($member, $amount, $wallet=null) {
        // check if there is any available shares to buy
        // sort from highest price
        $state = $this->getCurrentShareState();
        $origAmount = $amount;
        $sharesToBuy = $this->modelSell->where('has_process', 0)
            ->where('member_id', '!=', $member->id)
            ->orderBy('is_admin', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('share_price', 'desc')
            ->get();
        $quantity = 0;
        if (count($sharesToBuy) <= 0 || $state->always_company) { // no shares to buy
            return false;
        } else {
            $sharePrice = 0;
            $amountTotal = 0;
            if (is_null($wallet)) $wallet = $member->wallet;
            foreach ($sharesToBuy as $shares) {
                if ($sharePrice < $shares->share_price) $sharePrice = $shares->share_price;
                $amountToSell = $shares->amount_left * $shares->share_price;
                if ($amountToSell > $amount) { // available shares more than amount

                    $quantityToBuy = $amount / $shares->share_price;
                    $checkQ = $quantityToBuy % 10;
                    if ($checkQ != 0) {
                        $quantityToBuy = floor($quantityToBuy - $checkQ);
                    }
                    $shares->amount_left -= $quantityToBuy;
                    $quantity += $quantityToBuy;
                    $amountTotal += $quantityToBuy * $shares->share_price;
                    $shares->save();

                    \DB::table('Shares_Buy')->insert([
                        'amount'    =>  $quantityToBuy,
                        'amount_left'   =>  $quantityToBuy,
                        'member_id' =>  $member->id,
                        'has_process'   =>  0,
                        'share_price'   =>  is_null($sharePrice) ? 0 : $sharePrice,
                        'total' =>  $quantityToBuy * $shares->share_price,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    \DB::table('Member_Freeze_Shares')->insert([
                        'member_id' =>  $member->id,
                        'amount'    =>  $quantityToBuy,
                        'active_date'   =>  Carbon::now()->addDays(15),
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    $wallet->purchase_point -= $quantityToBuy * $shares->share_price;
                    if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;

                } else { // available shares less than amount

                    $quantityToBuy = $shares->amount_left;
                    $checkQ = $quantityToBuy % 10;
                    if ($checkQ != 0) {
                        $quantityToBuy = floor($quantityToBuy - $checkQ);
                    }
                    $shares->amount_left = 0;
                    $shares->has_process = 1;
                    $quantity += $quantityToBuy;
                    $amountTotal += $quantityToBuy * $shares->share_price;
                    $shares->save();

                    \DB::table('Shares_Buy')->insert([
                        'amount'    =>  $quantityToBuy,
                        'amount_left'   =>  $quantityToBuy,
                        'member_id' =>  $member->id,
                        'has_process'   =>  0,
                        'share_price'   =>  is_null($sharePrice) ? 0 : $sharePrice,
                        'total' =>  $quantityToBuy * $shares->share_price,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    \DB::table('Member_Freeze_Shares')->insert([
                        'member_id' =>  $member->id,
                        'amount'    =>  $quantityToBuy,
                        'active_date'   =>  Carbon::now()->addDays(15),
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    $wallet->purchase_point -= $quantityToBuy * $shares->share_price;
                    if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;

                }

                // process the shares sales, if it is not admin
                if (!$shares->is_admin) {
                    $this->processSalesShares($shares, $quantityToBuy);
                }

                $amount -= $amountToSell;
                if ($amount <= 0) break;
            }

            if ($amount > 0) {
                $quantityLeft = round($amount / $state->current_price);
                $checkQ = $quantityLeft % 10;
                if ($checkQ != 0) {
                    $quantityLeft = floor($quantityLeft - $checkQ);
                }
                $quantity += $quantityLeft;
                $amountTotal += $quantityToBuy * $state->current_price;

                \DB::table('Shares_Buy')->insert([
                    'amount'    =>  $quantityLeft,
                    'amount_left'   =>  $quantityLeft,
                    'member_id' =>  $member->id,
                    'has_process'   =>  0,
                    'share_price'   =>  $state->current_price,
                    'total' =>  $quantityLeft * $state->current_price,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now()
                ]);

                \DB::table('Member_Freeze_Shares')->insert([
                    'member_id' =>  $member->id,
                    'amount'    =>  $quantityLeft,
                    'active_date'   =>  Carbon::now()->addDays(15),
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now()
                ]);

                $wallet->purchase_point -= $quantityLeft * $quantityLeft * $state->current_price;
                if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;
            }

            $this->accumulateSharesState(null, $quantity);

            $wallet->save();
            return $origAmount - $amountTotal;
        }
        return true;
    }

    /**
     * Auto Repurchase - When Register\Upgrade
     * @param  App\Models\Member $member
     * @param  float $amount [amount, NOT quantity]
     * @param  object $wallet [optional]
     * @return boolean
     */
    public function repurchasePackage ($member, $amount, $wallet=null) {
        // check if there is any available shares to buy
        $state = $this->getCurrentShareState();
        $sharesToBuy = $this->modelSell->where('has_process', 0)->where('member_id', '!=', $member->id);
        if ($state->always_company) {
            $sharesToBuy = $sharesToBuy->where('is_admin', 1);
        }

        // sort from lowest price
        $sharesToBuy = $sharesToBuy
            ->orderBy('is_admin', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('share_price', 'asc')
            ->get();

        $quantity = 0;

        if (count($sharesToBuy) <= 0 || $state->always_company) { // no shares to buy, buy from company

            $quantity = round($amount / $state->current_price);

            $checkQuantity = $quantity % 10;
            if ($checkQuantity != 0) {
                $quantity = floor($quantity - $checkQuantity);
            }

            $total = $quantity * $state->current_price;
            if ($total > $amount) $total = $amount;

            \DB::table('Shares_Buy')->insert([
                'amount'    =>  $quantity,
                'amount_left'   =>  $quantity,
                'member_id' =>  $member->id,
                'has_process'   =>  0,
                'share_price'   =>  $state->current_price,
                'total' =>  $total,
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now()
            ]);

            \DB::table('Member_Freeze_Shares')->insert([
                'member_id' =>  $member->id,
                'amount'    =>  $quantity,
                'active_date'   =>  Carbon::now()->addDays(30),
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now()
            ]);

            if (is_null($wallet)) $wallet = $member->wallet;
            $wallet->purchase_point -= $total;
            if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;
            $wallet->save();
            $this->accumulateSharesState(null, $quantity);

        } else {
            $sharePrice = 0;
            $amountTotal = 0;
            if (is_null($wallet)) $wallet = $member->wallet;
            foreach ($sharesToBuy as $shares) {
                $shares = $this->modelSell->where('id', $shares->id)->first(); // get the REAL value of the sales
                if ($sharePrice < $shares->share_price) $sharePrice = $shares->share_price;
                $amountToSell = $shares->amount_left * $shares->share_price;
                if ($amountToSell > $amount) { // available shares more than amount
                    $quantityToBuy = $amount / $shares->share_price;
                    $checkQ = $quantityToBuy % 10;
                    if ($checkQ != 0) {
                        $quantityToBuy = floor($quantityToBuy - $checkQ);
                    }
                    $shares->amount_left -= $quantityToBuy;
                    $quantity += $quantityToBuy;
                    $amountTotal += $quantityToBuy * $shares->share_price;
                    $shares->save();

                    \DB::table('Shares_Buy')->insert([
                        'amount'    =>  $quantityToBuy,
                        'amount_left'   =>  $quantityToBuy,
                        'member_id' =>  $member->id,
                        'has_process'   =>  0,
                        'share_price'   =>  is_null($sharePrice) ? 0 : $sharePrice,
                        'total' =>  $quantityToBuy * $shares->share_price
                    ]);

                    \DB::table('Member_Freeze_Shares')->insert([
                        'member_id' =>  $member->id,
                        'amount'    =>  $quantityToBuy,
                        'active_date'   =>  Carbon::now()->addDays(30),
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    $wallet->purchase_point -= $quantityToBuy * $shares->share_price;
                    if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;
                    // $this->accumulateSharesState(null, $quantityToBuy);

                } else { // available shares less than amount

                    $quantityToBuy = $shares->amount_left;
                    $checkQ = $quantityToBuy % 10;
                    if ($checkQ != 0) {
                        $quantityToBuy = floor($quantityToBuy - $checkQ);
                    }
                    $shares->amount_left = 0;
                    $shares->has_process = 1;
                    $quantity += $quantityToBuy;
                    $shares->save();

                    \DB::table('Shares_Buy')->insert([
                        'amount'    =>  $quantityToBuy,
                        'amount_left'   =>  $quantityToBuy,
                        'member_id' =>  $member->id,
                        'has_process'   =>  0,
                        'share_price'   =>  is_null($sharePrice) ? 0 : $sharePrice,
                        'total' =>  $quantityToBuy * $shares->share_price,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    \DB::table('Member_Freeze_Shares')->insert([
                        'member_id' =>  $member->id,
                        'amount'    =>  $quantityToBuy,
                        'active_date'   =>  Carbon::now()->addDays(30),
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);

                    $wallet->purchase_point -= $quantityToBuy * $shares->share_price;
                    if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;
                    // $this->accumulateSharesState(null, $quantityToBuy);

                }
                // process the shares sales, if it is not admin
                if (!$shares->is_admin) {
                    $this->processSalesShares($shares, $quantityToBuy);
                }
                $amount -= $amountToSell;
                if ($amount <= 0) break;
            }

            if ($amount > 0) {
                $quantityLeft = round($amount / $state->current_price);
                $checkQ = $quantityLeft % 10;
                if ($checkQ != 0) {
                    $quantityLeft = floor($quantityLeft - $checkQ);
                }
                $quantity += $quantityLeft;
                $this->saveModel($this->modelBuy, [
                    'amount'    =>  $quantityLeft,
                    'amount_left'   =>  $quantityLeft,
                    'member_id' =>  $member->id,
                    'has_process'   =>  0,
                    'share_price'   =>  $state->current_price,
                    'total' =>  $quantityLeft * $state->current_price,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now()
                ]);

                \DB::table('Member_Freeze_Shares')->insert([
                    'member_id' =>  $member->id,
                    'amount'    =>  $quantityLeft,
                    'active_date'   =>  Carbon::now()->addDays(30),
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now()
                ]);

                $wallet->purchase_point -= $quantityLeft * $state->current_price;
                if ($wallet->purchase_point < 0) $wallet->purchase_point = 0;
                // $this->accumulateSharesState(null, $quantityLeft);
            }

            $this->accumulateSharesState(null, $quantity);
            $wallet->save();
        }
        return true;
    }

    /**
     * Sell Shares
     * @param  App\Models\Member $member
     * @param  integer $quantity [Amount of shares in unit]
     * @param  decimal $price [Selected price to buy]
     * @return boolean
     */
    public function sellShares ($member, $quantity, $price) {
        $state = $this->getCurrentShareState();
        $max = $state->current_price + $this->sellRange;
        $min = $state->current_price - $this->sellRange;

        if ($price > $max || $price < $min) {
            throw new \Exception(\Lang::get('error.sellSharesProcessError'), 1);
            return false;
        }

        if ($quantity%10 != 0) {
            throw new \Exception(\Lang::get('error.sharesQuantityError'), 1);
            return false;
        }

        $shares = $member->shares;
        if ($shares->amount < $quantity) {
            throw new \Exception(\Lang::get('error.sharesQuantityError'), 1);
            return false;
        }

        if (!$this->checkCanSell($member, $shares, $quantity)) {
            throw new \Exception(\Lang::get('error.sharesLimitError'), 1);
            return false;
        }

        // add shares value to wallet
        $amount = $quantity * $price;

        // update shares wallet
        $shares->amount -= $quantity;
        $shares->current_sales += $quantity;
        if ($shares->current_sales > $shares->max_share_sale) {
            $shares->amount = 0;
        }
        $shares->save();

        $values = $this->sellSharesValue;

        // add sales record
        $this->saveModel($this->modelSell, [
            'member_id' => $member->id,
            'amount'    => $quantity,
            'amount_left' => $quantity,
            'share_price' => $price,
            'total' =>  $amount,
            'cash_point' => ($values['cash'] / 100) * $amount,
            'md_point' => ($values['point'] / 100) * $amount,
            'purchase_point' => (float) ($values['buyBack'] / 100) * $amount,
            'admin_fee' => ($values['fee'] / 100) * $amount,
            'is_admin' => false
        ]);

        return true;
    }

    /**
     * Admin Sell Shares
     * @param  integer $quantity [Amount of shares in unit]
     * @param  decimal $price [Selected price to buy]
     * @return boolean
     */
    public function adminSellShares ($quantity, $price) {
        $state = $this->getCurrentShareState();

        $this->saveModel($this->modelSell, [
            'member_id' => 0,
            'amount'    => $quantity,
            'amount_left' => $quantity,
            'share_price' => $price,
            'total' =>  $price * $quantity,
            'is_admin' => true
        ]);

        // $this->accumulateSharesState($state, $quantity);
        return true;
    }

    /**
     * Accumulate global shares state
     * @param  object $state
     * @param  integer $quantity
     * @return boolean
     */
    public function accumulateSharesState ($state=null, $quantity) {
        if (is_null($state)) {
            $state = \DB::table('Shares_Centre')->first();
        }

        $total = $state->current_accumulate + $quantity;
        if ($total > $state->raise_limit) {
            $left = $total;
            $price = $state->current_price;
            while ($left >= $state->raise_limit) {
                $price += $state->raise_by;
                $left -= $state->raise_limit;
            }
            \DB::table('Shares_Centre')->update([
                'current_price' => $price,
                'current_accumulate' => $left
            ]);
        } else {
            \DB::table('Shares_Centre')->update([
                'current_accumulate' => $state->current_accumulate + $quantity
            ]);
        }
        \Cache::forget('shares.state');
        return true;
    }

    /**
     * Remove all shares in queue, add back to member
     * Used when split
     * @return boolean
     */
    public function removeQueueShares () {
        $this->modelSell->where('has_process', 0)->chunk(100, function ($shares) {
            foreach ($shares as $share) {
                if (!$share->is_admin) {
                    if ($member = $share->member) {
                        if ($memberShares = $member->shares) {
                            $memberShares->amount += $share->amount_left;

                            \DB::table('Shares_Return_Statement')->insert([
                                'amount' => $share->amount_left,
                                'username' => $member->username,
                                'member_id' => $member->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);

                            $memberShares->save();
                        }
                    }

                    // record sales
                    \DB::table('Shares_Sell_Statement')->insert([
                        'member_id' => $member->id,
                        'sell_id' => $share->id,
                        'amount' => $share->amount_left,
                        'share_price' => $share->share_price,
                        'cash_point' => 0,
                        'purchase_point' => 0,
                        'md_point' => 0,
                        'admin_fee' => 0,
                        'status' => 'return',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }

                $share->amount_left = 0;
                $share->has_process = 1;
                $share->save();
            }
        });
        return true;
    }

    /**
     * Split shares
     * @param  float $splitTo
     * @param  integer $splitMult
     * @return boolean
     */
    public function splitShares ($splitTo, $splitMult=null) {
        if ($this->modelSell->where('has_process', 0)->count() > 0) {
            throw new \Exception(\Lang::get('error.splitSellStillExists'), 1);
            return false;
        }

        $state = $this->getCurrentShareState();
        if ($state->current_price < $splitTo) {
            throw new \Exception(\Lang::get('error.splitMoreThan'), 1);
            return false;
        }

        if (is_null($splitMult)) {
            $splitMult = round($state->current_price / $splitTo);
        }
        if ($splitMult <= 0) $splitTo = 1;

        // update shares state
        \DB::table('Shares_Centre')->update([
            'current_accumulate' =>  0,
            'current_price' =>  $splitTo
        ]);

        // update member shares
        if ($splitMult > 1) {
            $repo = new MemberRepository;
            $repo->updateSharesSplit($splitMult);
        }

        \Cache::forget('shares.state');
        return true;
    }

    /**
     * Buy List - DataTable
     * @param App\Models\Member $member
     * @return object
     */
    public function buyList ($member) {
        return Datatables::eloquent($this->modelBuy->where('member_id', $member->id))
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 0);
            })
            ->editColumn('total', function ($model) {
                return number_format($model->total, 2);
            })
            ->make(true);
    }

    /**
     * Sell List - DataTable
     * @param App\Models\Member $member
     * @return object
     */
    public function sellList ($member) {
        return Datatables::eloquent($this->modelSell->where('member_id', $member->id))
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 0);
            })
            ->editColumn('cash_point', function ($model) {
                return number_format($model->cash_point, 2);
            })
            ->editColumn('purchase_point', function ($model) {
                return number_format($model->purchase_point, 2);
            })
            ->editColumn('md_point', function ($model) {
                return number_format($model->md_point, 2);
            })
            ->editColumn('admin_fee', function ($model) {
                return number_format($model->admin_fee, 2);
            })
            ->editColumn('total', function ($model) {
                return number_format($model->total, 2);
            })
            ->editColumn('action', function ($model) {
                return view('front.shares.sellAction')->with('model', $model);
            })
            ->make(true);
    }

    /**
     * Freeze List - DataTable
     * @param App\Models\Member $member
     * @return object
     */
    public function freezeList ($member) {
        return Datatables::eloquent(\App\Models\MemberFreezeShares::where('member_id', $member->id))
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 0);
            })
            ->editColumn('has_process', function ($model) {
                if ($model->has_process) return '<label class="label label-success">YES</label>';
                else return '<label class="label label-danger">NO</label>';
            })
            ->rawColumns(['has_process'])
            ->make(true);
    }

    /**
     * Return List - DataTable
     * @param App\Models\Member $member
     * @return object
     */
    public function returnList ($member) {
        return Datatables::queryBuilder(\DB::table('Shares_Return_Statement')->where('member_id', $member->id))
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 0);
            })
            ->make(true);
    }

    /**
     * Split List - DataTable
     * @param App\Models\Member $member
     * @return object
     */
    public function splitList ($member) {
        return Datatables::queryBuilder(\DB::table('Shares_Split_Statement')->where('member_id', $member->id))
            ->editColumn('amount', function ($model) {
                return number_format($model->amount, 0);
            })
            ->make(true);
    }

    /**
     * Sell List Admin - DataTable
     * @return object
     */
    public function adminSellList () {
        return Datatables::eloquent(\App\Models\SharesSell::with('member')->select(['id', 'member_id', 'amount', 'amount_left', 'total', 'share_price', 'created_at']))
            ->addColumn('username', function ($model) {
                if ($member = $model->member) {
                    return $member->username;
                } else return 'Member Not Found.';
            })
            ->editColumn('created_at', function ($model) {
                return'<input type="text" class="form-control datepicker" name="created_at" value="' . $model->created_at . '" />';
            })
            ->editColumn('amount', function ($model) {
                return '<input type="number" class="form-control" name="amount" value="' . (integer) $model->amount . '" />';
            })
            ->editColumn('amount_left', function ($model) {
                return '<input type="number" class="form-control" name="amount_left" value="' . (integer) $model->amount_left . '" />';
            })
            ->editColumn('total', function ($model) {
                return '<input type="number" class="form-control" name="total" value="' . (float) $model->total . '" />';
            })
            ->editColumn('share_price', function ($model) {
                return '<input type="number" step="any" class="form-control" name="share_price" value="' . (float) $model->share_price . '" />';
            })
            ->addColumn('action', function ($model) {
                return view('back.shares.sellAction')->with('model', $model);
            })
            ->rawColumns(['created_at', 'amount', 'amount_left', 'total', 'share_price', 'action'])
            ->make(true);
    }

    /**
     * Buy List Admin - DataTable
     * @return object
     */
    public function adminBuyList () {
        return Datatables::eloquent(\App\Models\SharesBuy::with('member')->select(['id', 'member_id', 'amount', 'amount_left', 'total', 'share_price', 'created_at']))
            ->addColumn('username', function ($model) {
                if ($member = $model->member) {
                    return $member->username;
                } else return 'Member Not Found.';
            })
            ->editColumn('created_at', function ($model) {
                return'<input type="text" class="form-control datepicker" name="created_at" value="' . $model->created_at . '" />';
            })
            ->editColumn('amount', function ($model) {
                return '<input type="number" class="form-control" name="amount" value="' . (integer) $model->amount . '" />';
            })
            ->editColumn('amount_left', function ($model) {
                return '<input type="number" class="form-control" name="amount_left" value="' . (integer) $model->amount_left . '" />';
            })
            ->editColumn('total', function ($model) {
                return '<input type="number" class="form-control" name="total" value="' . (float) $model->total . '" />';
            })
            ->editColumn('share_price', function ($model) {
                return '<input type="number" step="any" class="form-control" name="share_price" value="' . (float) $model->share_price . '" />';
            })
            ->addColumn('action', function ($model) {
                return view('back.shares.buyAction')->with('model', $model);
            })
            ->rawColumns(['created_at', 'amount', 'amount_left', 'total', 'share_price', 'action'])
            ->make(true);
    }

    /**
     * Freeze List Admin - DataTable
     * @return object
     */
    public function adminFreezeList () {
        return Datatables::eloquent(\App\Models\MemberFreezeShares::with('member')->select(['id', 'member_id', 'amount', 'active_date', 'has_process', 'created_at']))
            ->editColumn('created_at', function ($model) {
                return'<input type="text" class="form-control" name="created_at" value="' . $model->created_at . '" />';
            })
            ->editColumn('active_date', function ($model) {
                return'<input type="text" class="form-control" name="active_date" value="' . $model->active_date . '" />';
            })
            ->editColumn('amount', function ($model) {
                return '<input type="number" class="form-control" name="amount" value="' . (float) $model->amount . '" />';
            })
            ->editColumn('has_process', function ($model) {
                if ($model->has_process) return '<label class="label label-success">YES</label>';
                else return '<label class="label label-danger">NO</label>';
            })
            ->addColumn('action', function ($model) {
                return view('back.shares.lockAction')->with('model', $model);
            })
            ->rawColumns(['created_at', 'active_date', 'has_process', 'amount', 'action'])
            ->make(true);
    }

}