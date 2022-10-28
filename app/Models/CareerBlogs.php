<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerBlogs extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__career_blog';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
    protected $fillable = ["uniq_id","status","blog_body","title","cover","include_image","tips_text","slug","section","language","meta_description"];
}
