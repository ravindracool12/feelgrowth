<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (\Sentinel::check()) {
                $user = \Sentinel::getUser();
                \View::share(['user' => $user]);
                $permissions = $user->permissions;
                if (isset($permissions['member'])) {
                    if (!\Cache::has('member.' . $user->id)) {
                        $member = $user->member;
                        $member->load('wallet');
                        $member->load('detail');
                        $member->load('shares');
                        \Cache::put('member.' . $user->id, $member, 60);
                    } else {
                        $member = \Cache::get('member.'. $user->id);
                    }
                    \View::share(['member' => $member]);
                }
            }
            return $next($request);
        });
    }
}
