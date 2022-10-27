<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__media';
    protected $primaryKey = 'uniq_id';
    public $incrementing= false;
    protected $fillable=["title","create_time","cover","incl_img","tips_txt","status","media_lang","meta_description"];
}
