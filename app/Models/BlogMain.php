<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogMain extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__blog_post';
    protected $primaryKey = 'uniq_id';
    public $incrementing= false;
    protected $fillable= ["status","blog_body","title","cover","include_image","tips_text","slug","section,language,meta_description"];
}
