<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonusGroup extends Model
{
    protected $table = 'Bonus_Group';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function member () {
        return $this->belongsTo(static::$memberModel, 'member_id');
    }
}