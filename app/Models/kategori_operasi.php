<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\skema_operasi;

class kategori_operasi extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'kategori_operasi';

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

    // relationship
    public function skema_operasi(){
        return $this->hasMany(skema_operasi::class);
    }
}