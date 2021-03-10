<?php

namespace App\Models\Coin;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'Coin_Transaction';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }
}