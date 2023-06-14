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

    public function user_member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function layanan()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    public function operasi()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
