<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenPassword extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'token_password';

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
