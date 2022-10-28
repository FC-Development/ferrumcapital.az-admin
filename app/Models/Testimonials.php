<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    use HasFactory;

    protected $hidden = ['id'];
    protected $table = 'nc_a5um__dinamic_main_web';
    protected $primaryKey = 'uniq_id';
    protected $fillable = ["uniq_id", "status", "youtube_url", "fullname", "quote", "title", "image", "company_logo"];
}
