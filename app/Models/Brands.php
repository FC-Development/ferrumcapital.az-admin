<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'nc_a5um__products';
    public $incrementing = false;
    protected $fillable = [
        'status', 'uniq_id', 'name', 'phone', 'adress', 'sector_id', 'city_id',
        'region_id', 'website', 'logo', 'links', 'slider_img_path', 'slider_img_m_path', 'slider_img_status'
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

}
?>
