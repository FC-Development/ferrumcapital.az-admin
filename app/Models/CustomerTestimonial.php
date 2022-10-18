<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTestimonial extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__testimonial_customer';
}
