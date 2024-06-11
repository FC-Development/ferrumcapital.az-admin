<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'city_id',
        'region_name',
        'created_at',
        'updated_at'
    ];

    public function brands()
    {
        return $this->hasMany(Brands::class, 'region_id', 'region_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
