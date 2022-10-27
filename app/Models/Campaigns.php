<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
    use HasFactory;
    protected $table = 'nc_a5um__campaigns';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
    protected $fillable = ["uniq_id" ,"answer", "en", "question"];
}
