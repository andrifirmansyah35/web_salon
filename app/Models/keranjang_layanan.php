<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang_layanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'int',
        'status' => 'boolean',
        'user_id' => 'int',
        'layanan_id' => 'int'
    ];

    public function layanan()
    {
        return $this->belongsTo(layanan::class, "layanan_id");
    }
}