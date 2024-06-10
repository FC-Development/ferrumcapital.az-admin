<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the regions for a given city_id.
     *
     * @param  int  $city_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRegionsByCityId($city_id)
    {
        $regions = Region::where('city_id', $city_id)->select('region_id', 'region_name')->get();
        return response()->json($regions);
    }
}
