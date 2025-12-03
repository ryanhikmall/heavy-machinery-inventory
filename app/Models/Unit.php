<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    // Ini kodenya. Mengizinkan input data 'name' dan 'model' masuk ke database.
    protected $guarded = [];

    // Relasi tambahan (Opsional)
    // Satu unit bisa punya banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}