<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'region_name',
        'city_id',
    ];

    /**
     * Get the city that owns the region.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
