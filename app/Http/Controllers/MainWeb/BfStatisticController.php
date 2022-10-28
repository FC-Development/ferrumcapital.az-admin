<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\BfStatisticAction;
use App\Http\Requests\MainWeb\StoreBfStatsRequest;

class BfStatisticController extends Controller
{
    //
    public function bfStatsPage()
    {
        return view('dashboard.main-web.bfstats');
    }
    public function getBfStats()
    {
        $bfStats= new BfStatisticAction();
        return $bfStats->getData();
    }
    public function postBfStats(StoreBfStatsRequest $request)
    {
        $postBfStats = new BfStatisticAction();
        $bfStats = $postBfStats->postData($request);
        return $bfStats;
    }
    public function updateBfStats(StoreBfStatsRequest $request)
    {
        $updateBfStats = new BfStatisticAction();
        $bfStats = $updateBfStats->updateData($request);
        return $bfStats;
    }
    public function deleteBfStats(Request $request)
    {
      $deletedBfStats = new BfStatisticAction();
      $bfStats = $deletedBfStats->deleteData($request);
      return response($bfStats);
    }
    public function findBfStats(Request $request)
    {
        $findBfStats = new BfStatisticAction();
        $bfStats = $findBfStats->findData($request);
        return $bfStats;
    }
}
