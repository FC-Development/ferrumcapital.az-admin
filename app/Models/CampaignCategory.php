<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCategory extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__categories';
    protected $primaryKey = 'uniq_id';
    public $incrementing= false;
    protected $fillable= ["id","uuid","name","slug"];
}
