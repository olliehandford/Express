<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discord extends Model
{
    public $incrementing = false;

    public function scopeMe($query) {
        return $query->where('user_id', Auth::user()->id);
    }
}
