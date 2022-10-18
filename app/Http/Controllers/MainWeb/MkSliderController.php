<?php

namespace App\Http\Controllers\MainWeb;

use App\Actions\Career\MkSliderAction as CareerMkSliderAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\MkSliderAction;
use Illuminate\Support\Facades\Http;
use App\Models\MkSlider;

class MkSliderController extends Controller
{

    public function mksliderPage(Request $request)
    {
        return view('dashboard.main-web.customer-slider');
    }
    public function getData()
    {
        $mk_action = new MkSliderAction();
        $mk_slider_data = mk_action->getData();
        return $mk_slider_data;
    }
}
