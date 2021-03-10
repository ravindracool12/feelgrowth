<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharesBuy extends Model
{
    protected $table = 'Shares_Buy';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }
}