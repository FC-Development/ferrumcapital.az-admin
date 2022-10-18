<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__products';
    protected $primaryKey='uniq_id';
    protected $fillable =['status'];
    public function sector()
    {
        return $this->belongsTo(BrandSectors::class,'sector_id','uniq_id');
    }
}
