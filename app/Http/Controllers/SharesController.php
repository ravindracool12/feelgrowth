<?php

namespace App\Http\Controllers;

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

    /**
     * Create a new SharesController instance.
     *
     * @param \App\Repositories\SharesRepository $SharesRepository
     * @return void
     */
    public function __construct(SharesRepository $SharesRepository) {
        $this->SharesRepository = $SharesRepository;
        $this->middleware('member');
    }

    /**
     * Member buy shares
     * @return [type] [description]
     */
    public function buy () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        try {
            $this->SharesRepository->buyShares($member, $data['quantity'], $data['price']);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        \Cache::forget('member.' . $user->id);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  \Lang::get('message.sharesBuySuccess'),
            'redirect'  =>  route('shares.market', ['lang' => \App::getLocale()])
        ]);
    }

    /**
     * Member sell shares
     * @return [type] [description]
     */
    public function sell () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();
        $member = $user->member;

        if ($member->secret_password != trim($data['s'])) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  \Lang::get('error.securityPasswordError')
            ]);
        }

        \Cache::forget('member.' . $user->id);

        try {
            $this->SharesRepository->sellShares($member, $data['quantity'], $data['price']);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  \Lang::get('message.sharesSellSuccess'),
            'redirect'  =>  route('shares.market', ['lang' => \App::getLocale()])
        ]);
    }

    /**
     * Get Graph Data - D3/C3
     * @return array
     */
    public function getGraph () {
        $user = \Sentinel::getUser();
        $member = $user->member;

        if (!\Input::has('min')) {
            $state = $this->SharesRepository->getCurrentShareState();
            $min = $state->current_price;
        } else {
            $min = trim(\Input::get('min'));
        }

        $max = $min + 0.020;
        $sales = $this->SharesRepository->getSalesByMember($min, $max);
        $data = [0 => ['amount'], 1 => ['price']];
        $total = 0;
        // prepare price array
        for ($i=$min; $i<=$max; $i+=0.001) {
            array_push($data[0], 0);
            array_push($data[1], number_format($i, 3));
        }

        if (count($sales) > 0) {
            foreach ($sales as $sale) {
                $check = number_format($sale->price, 3);
                $index = array_search($check, $data[1]);
                if (isset($data[0][$index])) {
                    $total += $sale->amount_left;
                    $data[0][$index] = $sale->amount;
                }
            }
        }

        return \Response::json([
            'type'  => 'success',
            'data'  => $data,
            'total' => number_format($total, 0)
        ]);
    }

    /**
     * All sales shares - DataTable
     * @return [type] [description]
     */
    public function getSellList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->SharesRepository->sellList($member);
    }

    /**
     * All purchase shares - DataTable
     * @return [type] [description]
     */
    public function getBuyList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->SharesRepository->buyList($member);
    }

    /**
     * All freeze shares - DataTable
     * @return [type] [description]
     */
    public function getFreezeList () {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->SharesRepository->freezeList($member);
    }

    /**
     * Get Sales Statement
     * @param integer $id [sales id]
     * @return html
     */
    public function getSalesStatement ($lang, $id) {
        return view('front.shares.sellStatement')->with('id', trim($id));
    }

    /**
     * Get Return Statement
     * @return html
     */
    public function getReturnList ($lang) {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->SharesRepository->returnList($member);
    }

    /**
     * Get Split Statement
     * @return html
     */
    public function getSplitList ($lang) {
        $user = \Sentinel::getUser();
        $member = $user->member;
        return $this->SharesRepository->splitList($member);
    }
}
