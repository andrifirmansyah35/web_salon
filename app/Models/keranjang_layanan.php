<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang_layanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function layanan()
    {
        return $this->belongsTo(layanan::class, "layanan_id");
    }
}
