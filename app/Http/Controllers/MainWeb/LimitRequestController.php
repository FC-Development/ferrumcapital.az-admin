<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\BfStatisticAction;

class LimitRequestController extends Controller
{
    //
    public function limitPage()
    {
        return view('dashboard.main-web.limit-request');
    }
}
