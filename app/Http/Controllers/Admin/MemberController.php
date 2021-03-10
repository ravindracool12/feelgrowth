<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\MemberRepository;
use App\Repositories\PackageRepository;
use App\Repositories\SharesRepository;
use App\Repositories\BonusRepository;
use Yajra\Datatables\Facades\Datatables;

class MemberController extends Controller
{
    /**
     * The MemberRepository instance.
     *
     * @var \App\Repositories\MemberRepository
     */
    protected $MemberRepository;

    /**
     * The PackageRepository instance.
     *
     * @var \App\Repositories\PackageRepository
     */
    protected $PackageRepository;

    /**
     * The SharesRepository instance.
     *
     * @var \App\Repositories\SharesRepository
     */
    protected $SharesRepository;

    /**
     * The PackageRepository instance.
     *
     * @var \App\Repositories\PackageRepository
     */
    protected $BonusRepository;

    /**
     * Create a new MemberController instance.
     *
     * @param \App\Repositories\MemberRepository $MemberRepository
     * @return void
     */
    public function __construct(
        MemberRepository $MemberRepository,
        PackageRepository $PackageRepository,
        SharesRepository $SharesRepository,
        BonusRepository $BonusRepository
    ) {
        $this->middleware('admin');
        $this->MemberRepository = $MemberRepository;
        $this->PackageRepository = $PackageRepository;
        $this->SharesRepository = $SharesRepository;
        $this->BonusRepository = $BonusRepository;
    }

    /**
     * Datatable member admin
     * @return object
     */
    public function getList () {
        return $this->MemberRepository->findAll(true);
    }

    /**
     * Datatable member wallet admin
     * @return object
     */
    public function getWalletList () {
        return $this->MemberRepository->findWalletList(true);
    }

    /**
     * Datatable member wallet statement
     * @return [type] [description]
     */
    public function getWalletStatementList ($id) {
        $query = \DB::table('Member_Wallet_Statement')
            ->where('member_id', trim($id));
        return Datatables::queryBuilder($query)
                ->editColumn('register_amount', function ($model) {
                    return number_format($model->register_amount, 2);
                })
                ->editColumn('promotion_amount', function ($model) {
                    return number_format($model->promotion_amount, 2);
                })
                ->make(true);
    }

    /**
     * Register member (ROOT)
     * @return json
     */
    public function register ($type) {
        $data = \Input::get('data');

        if (!$package = $this->PackageRepository->findById($data['package_id'])) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Package not found.'
            ]);
        }

        if (($type != 'root' && $type != 'common') || !isset($type)) {
            return \Response::json([
                'type' => 'error',
                'message' => 'Type not found.'
            ]);
        }
        try {
            $user = \Sentinel::registerAndActivate([
                'email'   => $data['email'],
                'username'  =>  $data['username'],
                'password'  =>  $data['password'],
                'permissions' =>  [
                    'member' => true,
                ]
            ]);

            if ($type == 'root') { // top member
                $member = $this->MemberRepository->saveModel(new \App\Models\Member, [
                    'username'  =>  $user->username,
                    'register_by' => 'admin',
                    'secret_password' =>  $data['secret_password'],
                    'user_id'   =>  $user->id,
                    'package_id'    =>  $package->id,
                    'direct_id' =>  0,
                    'parent_id' =>  0,
                    'root_id'   =>  0,
                    'level'     =>  1,
                    'direct_percent'    =>  $package->direct_percent,
                    'pairing_percent'   =>  $package->pairing_percent,
                    'group_level'   =>  $package->group_level,
                    'max_pair'  =>  $package->max_pair,
                    'max_pairing_bonus' =>  $package->max_pairing_bonus,
                    'original_amount'  =>  $package->package_amount,
                    'package_amount'    =>  $package->package_amount,
                    'position'  =>  'top'
                ]);
                $this->MemberRepository->saveModel(new \App\Models\MemberWallet, [
                    'member_id' =>  $member->id,
                    'register_point'    =>  0,
                    'purchase_point'    =>  $package->purchase_point,
                    'promotion_point'   =>  0,
                    'cash_point'    =>  0,
                    'md_point'  =>  0
                ]);
            } else { // lower member
                if (!$direct = $this->MemberRepository->findByUsername($data['direct_id'])) {
                    throw new \Exception('Member upline not found.', 1);
                    return false;
                }

                if (!$parent = $this->MemberRepository->findByUsername($data['parent_id'])) {
                    throw new \Exception('Member binary not found.', 1);
                    return false;
                }

                if (!$this->MemberRepository->checkIfPositionAvailable($parent, $data['position'])) {
                    throw new \Exception('Position no longer available.', 1);
                    return false;
                }

                $member = $this->MemberRepository->saveModel(new \App\Models\Member, [
                    'username'  =>  $user->username,
                    'register_by' => 'admin',
                    'secret_password' =>  $data['secret_password'],
                    'user_id'   =>  $user->id,
                    'package_id'    =>  $package->id,
                    'direct_id' =>  $direct->id,
                    'parent_id' =>  $parent->id,
                    'root_id'   =>  ($parent->position == $data['position']) ? $parent->root_id : $parent->id,
                    'level'     =>  $parent->level + 1,
                    'direct_percent'    =>  $package->direct_percent,
                    'pairing_percent'   =>  $package->pairing_percent,
                    'group_level'   =>  $package->group_level,
                    'max_pair'  =>  $package->max_pair,
                    'max_pairing_bonus' =>  $package->max_pairing_bonus,
                    'original_amount'  =>  $package->package_amount,
                    'package_amount' =>  $package->package_amount,
                    'position'  =>  $data['position']
                ]);

                $this->MemberRepository->saveModel(new \App\Models\MemberWallet, [
                    'member_id' =>  $member->id,
                    'register_point'    =>  0,
                    'purchase_point'    =>  $package->purchase_point,
                    'promotion_point'   =>  0,
                    'cash_point'    =>  0,
                    'md_point'  =>  0
                ]);

                if (env('APP_ENV') == 'local') { // local
                    $wallet = $member->wallet;
                    $this->MemberRepository->addNetwork($member);
                    $this->SharesRepository->repurchasePackage($member, $wallet->purchase_point, $wallet);
                } else { // production
                    dispatch(new SharesAfterRegisterJob($member))->onQueue('queue-shares-register');
                    dispatch(new NetworkAfterRegisterJob($member))->onQueue('queue-network-register');
                }

                // remove cache for network
                \Cache::forget('member.' . $parent->id . '.children');

                $this->BonusRepository->calculateDirect($member, $direct);
                $this->BonusRepository->calculateOverride($member);
            }

            $this->MemberRepository->saveModel(new \App\Models\MemberDetail, [
                'member_id' =>  $member->id
            ]);

            $this->MemberRepository->saveModel(new \App\Models\MemberShares, [
                'member_id' =>  $member->id,
                'amount'    =>  0,
                'share_limit'   =>  $package->share_limit,
                'max_share_sale'    =>  $package->max_share_sale
            ]);
        } catch (\Exception $e) {
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }
        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Register successful.'
        ]);
    }

    /**
     * Update member data
     * @return json
     */
    public function postUpdate ($id) {
        $data = \Input::get('data');
        $member = $this->MemberRepository->findById(trim($id));
        $user = $member->user;
        $userData = [];

        if (isset($data['first_name'])) {
            $userData['first_name'] = $data['first_name'];
        }

        if (isset($data['password'])) {
            if ($data['password'] != '') {
                $userData['password'] = $data['password'];
            }
        }
        if (isset($data['is_update_basic'])) {
            $userData['is_ban'] = isset($data['is_ban']) ? 1 : 0;
        }

        \Sentinel::update($user, $userData);

        $detail = $member->detail;
        $wallet = $member->wallet;
        $shares = $member->shares;
        $original = $member->original_amount;

        foreach ($member->getAttributes() as $k => $value) {
            if (isset($data[$k])) $member->{$k} = $data[$k];
        }

        foreach ($detail->getAttributes() as $k => $value) {
            if ($k != 'created_at') {
                if (isset($data[$k])) $detail->{$k} = $data[$k];
            }
        }

        foreach ($wallet->getAttributes() as $k => $value) {
            if ($k != 'created_at' || 
                $k != 'lock_cash' || 
                $k != 'lock_register' || 
                $k != 'lock_promotion') {
                if (isset($data[$k])) $wallet->{$k} = $data[$k];
            }
        }

        if (isset($data['is_update_wallet'])) {
            $wallet->lock_cash = isset($data['lock_cash']) ? 1 : 0;
            $wallet->lock_register = isset($data['lock_register']) ? 1 : 0;
            $wallet->lock_promotion = isset($data['lock_promotion']) ? 1 : 0;
        }

        foreach ($shares->getAttributes()as $k => $value) {
            if ($k != 'created_at') {
                if (isset($data[$k])) $shares->{$k} = $data[$k];
            }
        }

        $member->save();
        $detail->save();
        $wallet->save();
        $shares->save();

        if (isset($data['original_amount'])) {
            if ($original != $data['original_amount']) {
                $this->updateSalesAmount($member, $original, $data['original_amount']);
            }
        }

        \Cache::forget('member.' . $user->id);

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Member account updated.'
        ]);
    }

    /**
     * [updateSalesAmount description]
     * @param  [type] $member [description]
     * @param  [type] $amount [description]
     * @return [type]         [description]
     */
    public function updateSalesAmount ($member, $amountFrom, $amountTo) {
        $befores = '';
        $beforeChildren = '';
        $isSub = false;
        $amount = $amountTo - $amountFrom;
        if ($amount == 0) return false;
        if ($amount < 0) {
            $amount = abs($amount);
            $isSub = true;
        }
        if ($parent = $member->parent()) {
            $alwaysRemove = explode(',', $member->position == 'right' ? $parent->left_children : $parent->right_children);
        }

        while ($root = $member->root()) {
            if ($member->position == 'left') {
                $memberIds = $root->left_children;
                $position = 'left_children';
                $totalField = 'left_total';
            } else {
                $memberIds = $root->right_children;
                $position = 'right_children';
                $totalField = 'right_total';
            }

            $memberIds = rtrim($root->id . ',' . $memberIds, ',');
            $memberIds = explode(',', $memberIds);

            if ($befores != '') {
                $memberIds = array_diff($memberIds, explode(',', $befores));
            }

            if (isset($alwaysRemove)) {
                $memberIds = array_diff($memberIds, $alwaysRemove);
            }

            if ($beforeChildren != '') {
                $memberIds = array_diff($memberIds, explode(',', $beforeChildren));
            }

            $memberIds = implode(',', $memberIds);

            if ($root->position == 'top') {
                \DB::update('UPDATE tb_Member SET ' . $totalField . '=' . $totalField . ($isSub ? ' - ' : ' + ') . $amount . ' WHERE id IN (' . $memberIds . ') AND position="' . $member->position . '" AND level < ' . $member->level . ' AND root_id=' . $member->root_id);
                \DB::update('UPDATE tb_Member SET ' . $totalField . '=' . $totalField . ($isSub ? ' - ' : ' + ') . $amount . ' WHERE id IN (' . $memberIds . ') AND position="top" AND level < ' . $member->level);
            } else {
                \DB::update('UPDATE tb_Member SET ' . $totalField . '=' . $totalField . ($isSub ? ' - ' : ' + ') . $amount . ' WHERE id IN (' . $memberIds . ') AND position="' . $member->position . '" AND level < ' . $member->level . ' AND root_id=' . $member->root_id);
                \DB::update('UPDATE tb_Member SET ' . $totalField . '=' . $totalField . ($isSub ? ' - ' : ' + ') . $amount . ' WHERE id=' . $root->id . ' AND level < ' . $member->level);
            }

            $beforeChildren .= ',' . ($root->position == 'left' ? $root->left_children : $root->right_children);
            $beforeChildren = ltrim($beforeChildren, ',');
            $befores .= ',' . $memberIds;
            $member = $root;
        }

        return true;
    }

    /**
     * Find member info when register
     * @return html
     */
    public function getMemberRegisterModal () {
        $model = false;
        if (trim(\Input::get('u')) != '') {
            $model = $this->MemberRepository->findByUsername(trim(\Input::get('u')));
        }
        return view('front.member.modalRegister')->with('model', $model);
    }
}
