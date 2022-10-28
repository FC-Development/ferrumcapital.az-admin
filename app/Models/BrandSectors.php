<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandSectors extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $primaryKey = 'uniq_id';
    protected $table = 'nc_a5um__brand_sector';
    protected $fillable = ["uniq_id","title","cover"];
    public $incrementing= false;
    public function  brands() {
        return $this->hasMany(Brands::class,'sector_id','uniq_id');
    }
}
