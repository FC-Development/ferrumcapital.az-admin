<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Region;

class Brands extends Model
{
    use HasFactory;
    
    protected $table = 'nc_a5um__products';
    public $incrementing = false;
    protected $fillable = [
        'status', "uniq_id", "status", "name", "phone", "adress", "sector_id", "city_name", 
        "website", "logo", "links", "slider_img_path", "slider_img_m_path", "slider_img_status", 
        "city_id", "region_id"
    ];
    
    public $timestamps = false;

    public function sector()
    {
        return $this->belongsTo(BrandSectors::class, 'sector_id', 'uniq_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    public function getCityNameValueAttribute()
    {
        return $this->city ? $this->city_name : null;
    }

    public function getRegionNameValueAttribute()
    {
        return $this->region ? $this->region_name : null;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['city_name'] = $this->city;
        $array['region_name'] = $this->region;
        unset($array['city']);
        unset($array['region']);
        return $array;
    }
}
