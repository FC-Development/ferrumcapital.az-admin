<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessApply;
use Exception;
use Illuminate\Support\Facades\DB;

class CampaignsController extends Controller
{
    public function campaignsPage ()
    {
        return view('dashboard.main-web.campaigns');
    }
    
}
