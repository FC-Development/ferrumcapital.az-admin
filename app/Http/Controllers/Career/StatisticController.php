<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\StatisticAction;
use App\Http\Requests\Career\StoreStatisticRequest;
class StatisticController extends Controller
{
    //
    public function statisticPage()
    {
        return view('dashboard.career.statistic');
    }
    public function getCstatistic()
    {
        $statistic= new StatisticAction();
        return \response($statistic->getData());
    }
    public function postCstatistic(StoreStatisticRequest $request)
    {
        $postStats = new StatisticAction(); 
        $stats = $postStats->postData($request);
        return response($stats);
    }
    public function updateStats(StoreStatisticRequest $request)
    {
        $updateStats = new StatisticAction();
        $bfStats = $updateStats->updateData($request);
        return response("Success",200);
    }
    public function deleteStats(Request $request)
    {   
      $deletedStats = new StatisticAction();
      $stats = $deletedStats->deleteData($request);
      return response($stats);
    }
    public function findStats(Request $request)
    {
        $findStats = new StatisticAction();
        $stats = $findStats->findData($request);
        return response($stats);
    }
}
