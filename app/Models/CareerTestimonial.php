<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTestimonial extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__career_testimonials';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
    protected $fillable = ["uniq_id","fullname","text"];
}
