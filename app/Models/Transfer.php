<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'Transfer';
    protected $fillable = [];
    protected $hidden = [];

    protected static $memberModel = 'App\Models\Member';

    public function fromMember () {
        return $this->belongsTo(static::$memberModel, 'from_member_id');
    }

    public function toMember () {
        return $this->belongsTo(static::$memberModel, 'to_member_id');
    }
}