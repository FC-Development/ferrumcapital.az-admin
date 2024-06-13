<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Assuming 'id' is the primary key
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'city_id', // unique key
        'city_name'
    ];

    // If 'city_id' is not the default auto-incrementing primary key
    public $incrementing = false;
    protected $keyType = 'string';

    public function regions()
    {
        return $this->hasMany(Region::class, 'city_id', 'city_id');
    }

    public function brands()
    {
        return $this->hasMany(Brands::class, 'city_id', 'city_id');
    }
}
