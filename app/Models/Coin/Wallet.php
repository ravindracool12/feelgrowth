<?php

namespace App\Models\Coin;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'Coin_Wallet';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';
    protected static $addressModel = 'App\Models\Coin\WalletAddress';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }

    public function addresses () {
        return $this->hasMany(static::$addressModel, 'wallet_id');
    }
}