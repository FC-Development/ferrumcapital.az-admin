<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\PfStatisticAction;
use App\Http\Requests\MainWeb\StorePfStatsRequest;

class PfStatisticController extends Controller
{
    //
    public function pfStatsPage()
    {
        return view('dashboard.main-web.pfstats');
    }
    public function getPfStats()
    {
        $pfStats= new PfStatisticAction();
        return $pfStats->getData();
    }
    public function postPfStats(StorePfStatsRequest $request)
    {
        $postPfStats = new PfStatisticAction();
        $pfStats = $postPfStats->postData($request);
        return ($pfStats);
    }
    public function updatePfStats(StorePfStatsRequest $request)
    {
        $updatePfStats = new PfStatisticAction();
        $pfStats = $updatePfStats->updateData($request);
        return response("Success",200);
    }
    public function deletePfStats(Request $request)
    {
      $deletedPfStats = new PfStatisticAction();
      $pfStats = $deletedPfStats->deleteData($request);
      return ($pfStats);
    }
    public function findPfStats(Request $request)
    {
        $findPfStats = new PfStatisticAction();
        $pfStats = $findPfStats->findData($request);
        return ($pfStats);
    }
}
