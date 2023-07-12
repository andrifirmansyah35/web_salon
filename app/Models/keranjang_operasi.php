<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang_operasi extends Model
{
    use HasFactory;
    protected $table = 'keranjang_operasi';

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'int',
        'status' => 'boolean',
        'user_id' => 'int',
        'operasi_id' => 'int',
    ];
}
