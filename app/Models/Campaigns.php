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
    protected $hidden = ['id', 'status', 'updated_at'];
    public $incrementing = false;
    protected $fillable = ["uniq_id" ,"campaign_title", "campaign_image", "campaign_mobile_image", "description", "end_duration", "status", "slug"];
}
