<?php

namespace App\Models\Coin;

use Illuminate\Database\Eloquent\Model;

class WalletAddress extends Model
{
    protected $table = 'Coin_Address';
    protected $fillable = [];
    protected $hidden = [];

    protected static $walletModel = 'App\Models\Coin\Wallet';

    public function wallet () {
        return $this->belongsTo(static::$walletModel, 'wallet_id');
    }
}