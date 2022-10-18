<?php

namespace App\Http\Controllers\Career;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Actions\Career\ApplicationsAction;
use Illuminate\Console\Application;
use App\Http\Requests\Career\StoreApplication;
use App\Models\CareerApplication;
class ApplicationsController extends Controller
{
    private  ApplicationsAction $application;
    public function __construct(ApplicationsAction $application)
    {
        $this->application = $application;
    }

    //
    public function index()
    {
        return view('dashboard.career.applications');
    }
    public function getVacancy()
    {
        $data = $this->application->getData();
        return response($data);
    }
    public function postVacancy(StoreApplication $request)
    {
       $post = $this->application->postData($request);
       return response("success",200);
    }
    public function deleteVacancy()
    {

    }
    public function updateApplyStatus(Request $request,$uniq_id)
    {
        $updated_ = $this->application->updateDataStatus($request,$uniq_id);
        return response($updated_);
    }
    public function findData(Request $request,$id)
    {
        $find = $this->application->findData($id);
        return response($find);
    }
}
