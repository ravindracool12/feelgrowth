<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\MemberRepository;

class SiteController extends Controller
{
    public function __construct() {
        $this->middleware('admin', ['except' => [
            'getLogin',
            'postLogin',
            'getLogout'
        ]]);
    }

    public function getLogin () {
        return view('back.login');
    }

    public function getIndex () {
        return view('back.home');
    }

    public function getAccountSettings () {
        return view('back.settings');
    }

    public function getLogout () {
        if ($user = \Sentinel::getUser()) {
            \Sentinel::logout($user);
        }
        return view('back.login');
    }

    public function postLogin () {
        $data = \Input::get('data');

        try {
            $user = \Sentinel::authenticate([
                'username'  =>  $data['username'],
                'password'  =>  $data['password']
            ], (isset($data['remember'])));

            if (!$user) {
                throw new \Exception('Username / Password do not match.', 1);
                return false;
            }

            $permissions = $user->permissions;
            if (!isset($permissions['admin'])) {
                throw new \Exception('Cannot login here.', 1);
                return false;
            } else if ($permissions['admin'] != 1) {
                throw new \Exception('Cannot login here.', 1);
                return false;
            }
        } catch (\Exception $e) {
            \Sentinel::logout();
            return \Response::json([
                'type'  =>  'error',
                'message'   =>  $e->getMessage()
            ]);
        }

        return \Response::json([
            'type'      =>  'success',
            'message'   =>  'Redirecting to dashboard..',
            'redirect'  =>  route('admin.home'),
        ]);
    }

    public function postUpdateAccount () {
        $data = \Input::get('data');
        $user = \Sentinel::getUser();

        if ($data['password'] != '') {
            try {
                \Sentinel::update($user, [
                    'password'  =>  trim($data['password'])
                ]);
            } catch (\Exception $e) {
                return \Response::json([
                    'type'  =>  'error',
                    'message'   =>  $e->getMessage()
                ]);
            }
        }

        return \Response::json([
            'type'  =>  'success',
            'message'   =>  'Account updated.'
        ]);
    }

    public function getMemberList () {
        return view('back.member.list');
    }

    public function getMemberWallet () {
        return view('back.wallet.list');    
    }

    public function getWalletStatement ($id) {
        return view('back.wallet.statementList')->with('id', $id);
    }

    public function getMemberRegister () {
        return view('back.member.register');
    }

    public function getMemberRegisterCommon () {
        return view('back.member.register2');
    }

    public function getWithdrawAddStatement () {
        return view('back.withdraw.addStatement');
    }

    public function getWithdrawList () {
        return view('back.withdraw.list');
    }

    public function getTransferAddStatement () {
        return view('back.transfer.addStatement');
    }

    public function getTransferList () {
        return view('back.transfer.list');
    }

    public function getBonusAddStatement () {
        return view('back.bonus.addStatement');
    }

    public function getBonusList () {
        return view('back.bonus.list');
    }

    public function getPackageSettings () {
        return view('back.package.settings');
    }

    public function getSharesSettings () {
        return view('back.shares.settings');
    }

    public function getSharesSellAdmin () {
        return view('back.shares.sell');
    }

    public function getSharesSell () {
        return view('back.shares.sellList');
    }

    public function getSharesBuy () {
        return view('back.shares.buyList');
    }

    public function getSharesSplit () {
        return view('back.shares.split');
    }

    public function getSharesLock () {
        return view('back.shares.lockList');
    }

    public function getMemberEdit ($id) {
        $instance = new MemberRepository;
        if (!$model = $instance->findById(trim($id))) {
            return redirect()->route('admin.member.list')->with('flashMessage', [
                'class'  =>  'warning',
                'message'   =>  'Member not found.'
            ]);
        }
        return view('back.member.edit')->with('model', $model);
    }

    public function runCron () {
        if (\Input::get('type') == 'pairing') {
            \Artisan::call('bonus:pairing');
        } else if (\Input::get('type') == 'checkGroup') {
            \Artisan::call('member:group');
        } else if (\Input::get('type') == 'group') {
            \Artisan::call('bonus:group');
        } else if (\Input::get('type') == 'freeze') {
            \Artisan::call('shares:freeze');
        }

        return \Response::json([
            'type' => 'success',
            'message' => 'Job completed successfully'
        ]);
    }

    public function createAnnouncement () {
        return view('back.announcement.create');
    }

    public function getAnnouncementList () {
        return view('back.announcement.list');
    }

    public function maintenance () {
        if (\App::isDownForMaintenance()) {
            \Artisan::call('up');
        } else {
            \Artisan::call('down');
        }

        return \Response::json([
            'type'  =>  'information',
            'message' =>  'MT status toggled, refresh to see changes.'
        ]);
    }

    /**
     * Upload Image
     * @param  Request $req [description]
     * @return [type]       [description]
     */
    public function uploadImage (Request $req) {
        $validator = \Validator::make($req->all(), [
            'imageFile' => 'max:2048|mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return \Response::json([
                'type'  =>  'error',
                'message' =>  'File must be smaller than 2mb and in jpg or png format.'
            ]);
        }
        $file = $req->file('imageFile');
        $destinationPath = 'uploads/images/' . date('m') . '/';
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/' . $destinationPath, $filename);
        $image = $destinationPath . $filename;
        return \Response::json([
            'type'  =>  'success',
            'url'   =>  asset($image)
        ]);
    }

    public function getCoinWallet () {
        return view('back.coin.wallet');
    }

    public function getCoinTransaction () {
        return view('back.coin.transaction');
    }
}
