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
    public MkSlider $mk_slider;
    public MkSliderAction $mk_action;

    public function mksliderPage(Request $request)
    {
        return view('dashboard.main-web.customer-slider');
    }
    public function getData(MkSliderAction $mk_action)
    {
        $this->mk_action= $mk_action;
        $mk_slider_data = $this->mk_action->getData();
        return $mk_slider_data;
    }
}
