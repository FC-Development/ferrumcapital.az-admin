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
    public function vacancyPage()
    {
        return view('dashboard.career.vacancy');
    }
    public function getVacancy()
    {
        $obj = new VacancyAction();
        return response($obj->getData());
    }
    public function postVacancy(StoreVacancyRequest $request)
    {
        $obj = new VacancyAction();
        $postVacancy = $obj->postData($request);
        return response($postVacancy);
        return response('Successfully',200);
    }
    public function deleteVacancy(Request $request)
    {
        $obj = new VacancyAction();
        $deleteObj = $obj->deleteData($request);
        return response($deleteObj);
    }
    public function findVacancy(Request $request)
    {
        $obj = new VacancyAction();
        $findObj = $obj->findData($request);
        return response($findObj);
    }
    public function updateVacancyStatus(Request $request,$id)
    {
        $obj = new VacancyAction();
         $objUpdateStat=$obj->updateDataStatus($request,$id);
         return response($objUpdateStat);
    }
    public function updateVacancy(StoreVacancyRequest $request)
    {
        $obj = new VacancyAction();
        $updateObj = $obj->updateData($request);
        return response($updateObj);
    }
}
