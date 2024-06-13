<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // assuming 'id' is the primary key
    protected $fillable = [
        'region_id', // unique key
        'city_id', // foreign key
        'region_name'
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
