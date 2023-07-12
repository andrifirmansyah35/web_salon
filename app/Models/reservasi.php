<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'reservasi';
    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'int'
    ];

    public function user_member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwal_operasi()
    {
        return $this->belongsTo(jadwal_operasi::class, 'jadwal_operasi_id');
    }

    public function layanan()
    {
        return $this->belongsTo(layanan::class, 'layanan_id');
    }
    public function operasi()
    {
        return $this->belongsTo(operasi::class, 'operasi_id');
    }
}
