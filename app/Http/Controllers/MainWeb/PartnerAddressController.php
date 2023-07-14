<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use \App\Actions\MainWeb\PartnerAddressAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\PartnerAddressRequest;

class PartnerAddressController extends Controller
{
    public function PartnerAddressPage()
    {
        return view('dashboard.main-web.partner-address');
    }
    public function getPartnerAddress()
    {
        $response = new PartnerAddressAction();
        return $response->getData();
    }
    public function postPartnerAddress(PartnerAddressRequest $request)
    {
        $postPartnerAddress = new PartnerAddressAction(); 
        $partnerAddres = $postPartnerAddress->postData($request);
        return response($partnerAddres);
    }
    public function deletePartnerAddress(Request $request)
    {
        
      $deletedPartnerAddress = new PartnerAddressAction();
      $partnerAddres = $deletedPartnerAddress->deleteData($request);
      return response($partnerAddres);
    }
    public function findPartnerAddress(Request $request)
    {
        $findPartnerAddress = new PartnerAddressAction;
        $partnerAddres = $findPartnerAddress->findData($request);
        return response($partnerAddres);
    }
    public function updatePartnerAddressStatus(Request $request,$id)
    {
        $statusPartnerAddress = new PartnerAddressAction();
         $partnerAddres=$statusPartnerAddress->updateDataStatus($request,$id);
         return response($partnerAddres);
    }
    public function updatePartnerAddress(PartnerAddressRequest $request)
    {
        $updatePartnerAddress = new PartnerAddressAction();
        $partnerAddres = $updatePartnerAddress->updateData($request);
        return response("Success",200);
    }
}
