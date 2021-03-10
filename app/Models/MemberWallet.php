<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWallet extends Model
{
    protected $table = 'Member_Wallet';
    protected $fillable = [];
    protected $hidden = [];
    protected $primaryKey = 'member_id';

    protected static $memberModel = 'App\Models\Member';

    public function member () {
    	return $this->belongsTo(static::$memberModel, 'member_id');
    }
}