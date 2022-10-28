<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PfStatistic extends Model
{
    use HasFactory;
    protected $hidden = ['id'];
    protected $table = 'nc_a5um__pf_statistic';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
    protected $fillable = ["uniq_id","header","value","category"];
}
