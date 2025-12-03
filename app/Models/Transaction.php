<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function sparepart() {
        return $this->belongsTo(Sparepart::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
