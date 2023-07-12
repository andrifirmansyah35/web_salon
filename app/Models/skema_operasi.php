<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\kategori_operasi;

class skema_operasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'skema_operasi';

    protected $casts = [
        'id' => 'int',
        'kategori_operasi_id' => 'int'
    ];

    public function kategori_operasi()
    {
        return $this->belongTo(kategori_operasi::class);
    }
}
