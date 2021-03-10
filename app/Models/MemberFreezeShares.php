<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberFreezeShares extends Model
{
    protected $table = 'Member_Freeze_Shares';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }
}