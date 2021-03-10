<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'Member';
    protected $fillable = [];
    protected $hidden = [];

    protected static $userModel = 'Cartalyst\Sentinel\Users\EloquentUser';
    protected static $walletModel = 'App\Models\MemberWallet';
    protected static $detailModel = 'App\Models\MemberDetail';
    protected static $sharesModel = 'App\Models\MemberShares';
    protected static $freezeSharesModel = 'App\Models\MemberFreezeShares';
    protected static $coinWalletModel = 'App\Models\Coin\Wallet';

    public function user () {
        return $this->belongsTo(static::$userModel, 'user_id');
    }
    
    public function direct () {
        return $this->where('id', $this->direct_id)->first();
    }

    public function parent () {
        return $this->where('id', $this->parent_id)->first();
    }

    public function root () {
        return $this->where('id', $this->root_id)->first();
    }

    public function children () {
        return $this->where('direct_id', $this->id)->get();
    }

    public function wallet () {
        return $this->hasOne(static::$walletModel, 'member_id');
    }

    public function coinWallet () {
        return $this->hasMany(static::$coinWalletModel, 'member_id');
    }

    public function detail () {
        return $this->hasOne(static::$detailModel, 'member_id');
    }

    public function shares () {
        return $this->hasOne(static::$sharesModel, 'member_id');
    }

    public function freezeShares () {
        return $this->hasOne(static::$freezeSharesModel, 'member_id');
    }

    public function delete () {
        $this->wallet->delete();
        $this->detail->delete();
        $this->shares->delete();
        $this->freezeShares->delete();
        return parent::delete();
    }
}