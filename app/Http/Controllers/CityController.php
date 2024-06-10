<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the city IDs and names.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityNames()
    {
        $cities = City::select('city_id', 'city_name')->get();
        return response()->json($cities);
    }
}
