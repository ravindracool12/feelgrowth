<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharesSell extends Model
{
    protected $table = 'Shares_Sell';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }
}