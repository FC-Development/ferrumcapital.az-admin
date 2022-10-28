<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\StatisticAction;
use App\Http\Requests\Career\StoreStatisticRequest;
class StatisticController extends Controller
{
    //
    private $statistic;
    public function __construct(StatisticAction $statistic)
    {
        $this->statistic = $statistic;
    }
    public function statisticPage()
    {
        return view('dashboard.career.statistic');
    }
    public function getCstatistic()
    {
        $statistic= $this->statistic->getData();
        return $statistic;
    }
    public function postCstatistic(StoreStatisticRequest $request)
    {
        $stats = $this->statistic->postData($request);
        return ($stats);
    }
    public function updateStats(StoreStatisticRequest $request)
    {
        $bfStats = $this->statistic->updateData($request);
        return $bfStats;
    }
    public function deleteStats(Request $request)
    {
      $stats = $this->statistic->deleteData($request);
      return ($stats);
    }
    public function findStats(Request $request)
    {
        $stats = $this->statistic->findData($request);
        return ($stats);
    }
}
