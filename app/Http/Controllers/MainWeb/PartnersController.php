<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use \App\Actions\MainWeb\PartnersAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\PartnersRequest;

class PartnersController extends Controller
{
    public function PartnersPage()
    {
        return view('dashboard.main-web.partners');
    }
    public function getPartners()
    {
        $response = new PartnersAction();
        return $response->getData();
    }
    public function postPartners(PartnersRequest $request)
    {
        $postPartners = new PartnersAction(); 
        $partners = $postPartners->postData($request);
        return response($partners);
    }
    public function deletePartners(Request $request)
    {
        
      $deletedPartners = new PartnersAction();
      $partners = $deletedPartners->deleteData($request);
      return response($partners);
    }
    public function findPartners(Request $request)
    {
        $findPartners = new PartnersAction;
        $partners = $findPartners->findData($request);
        return response($partners);
    }
    public function updatePartnersStatus(Request $request,$id)
    {
        $statusPartners = new PartnersAction();
         $partners=$statusPartners->updateDataStatus($request,$id);
         return response($partners);
    }
    public function updatePartners(PartnersRequest $request)
    {
        $updatePartners = new PartnersAction();
        $partners = $updatePartners->updateData($request);
        return response("Success",200);
    }
}
