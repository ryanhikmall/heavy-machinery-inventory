<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Ini kodenya. Artinya: "Tidak ada kolom yang dijaga, semua boleh diisi."
    protected $guarded = [];
    
    // Relasi tambahan (Opsional, untuk persiapan nanti)
    // Satu kategori bisa punya banyak sparepart
    public function spareparts()
    {
        return $this->hasMany(Sparepart::class);
    }
}