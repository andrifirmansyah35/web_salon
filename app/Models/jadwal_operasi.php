<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_operasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_operasi';
    protected $guarded = ['id'];
}