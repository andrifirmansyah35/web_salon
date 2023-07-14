<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operasi extends Model
{
    use HasFactory;

    protected $table = 'operasi';
    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'int',
        'status' => 'boolean',
        'jadwal_operasi_id' => 'int'
    ];

    public function jadwal_operasi()
    {
        return $this->belongsTo(jadwal_operasi::class, 'jadwal_operasi_id');
    }
}
