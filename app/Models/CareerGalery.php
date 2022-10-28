<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGalery extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__cl_gallery';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
    protected $fillable = ['uniq_id','image_upload'];
}
