<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampaignRequest extends Controller
{
    //
    public function getView(): View
    {
        return view('dashboard.main-web.campaignrequest');
    }
}
