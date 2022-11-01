<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignRequest extends Model
{
    use HasFactory;
    protected $table = 'nc_a5um__mk_campaign_request';
    protected $primaryKey = 'uniq_id';
    public $incrementing = false;
}
