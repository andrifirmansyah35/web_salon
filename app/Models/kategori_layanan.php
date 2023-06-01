<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class kategori_layanan extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'kategori_layanan';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function layanan()
    {
        return $this->hasMany(layanan::class);
    }
}