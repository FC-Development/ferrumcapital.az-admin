<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__products';
    public $incrementing= false; 
    protected $fillable =['status',"uniq_id","status","name","phone","adress","sector_id","city","website","logo","links", "slider_img_path", "slider_img_status"];
    /**
         * Indicates if the model should be timestamped.
         *
         * @var bool
        */
    public $timestamps = false;

    public function sector()
    {
        return $this->belongsTo(BrandSectors::class,'sector_id','uniq_id');
    }
    
}
