<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cekout extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'layanan_id' => 'int',
    ];
}
