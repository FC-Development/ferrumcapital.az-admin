<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\MkSliderAction;
use Illuminate\Support\Facades\Http;
use App\Models\MkSlider;

class MkSliderController extends Controller
{
    private MkSliderAction $mk_action;
    public function __construct(MkSliderAction $mk_action)
    {
        $this->mk_action = $mk_action;
    }
    public function mksliderPage(Request $request)
    {
        return view('dashboard.main-web.customer-slider');
    }
    public function getData()
    {
        $mk_slider_data = $this->mk_action->getData();
        return $mk_slider_data;
    }
    public function postData(Request $request)
    {
        $create_data = $this->mk_action->postData($request);
        return $create_data;
    }
    public function deleteData(Request $request)
    {
        $deleted_data = $this->mk_action->deleteData($request);
        return $deleted_data;
    }
}
