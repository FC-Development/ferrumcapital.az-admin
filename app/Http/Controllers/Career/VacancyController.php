<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Console\PackageDiscoverCommand;
use App\Http\Requests\Career\StoreVacancyRequest;
use App\Actions\Career\VacancyAction;
class VacancyController extends Controller
{
    //
    private $vacancy;
    public function __construct(VacancyAction $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    public function vacancyPage()
    {
        return view('dashboard.career.vacancy');
    }
    public function getVacancy()
    {
        $obj = $this->vacancy->getData();
        return $obj;
    }
    public function postVacancy(StoreVacancyRequest $request)
    {
        $postVacancy = $this->vacancy->postData($request);
        return ($postVacancy);
    }
    public function deleteVacancy(Request $request)
    {
        $deleteObj = $this->vacancy->deleteData($request);
        return ($deleteObj);
    }
    public function findVacancy(Request $request)
    {
        $findObj = $this->vacancy->findData($request);
        return ($findObj);
    }
    public function updateVacancyStatus(Request $request,$id)
    {
         $objUpdateStat=$this->vacancy->updateDataStatus($request,$id);
         return ($objUpdateStat);
    }
    public function updateVacancy(StoreVacancyRequest $request)
    {
        $updateObj = $this->vacancy->updateData($request);
        return ($updateObj);
    }
}
