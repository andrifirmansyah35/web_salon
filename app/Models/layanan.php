<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class layanan extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'layanan';
    protected $guarded = ['id'];
    
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

    public function kategori_layanan()
    {
        return $this->belongsTo(kategori_layanan::class,'kategori_layanan_id');
    }
}