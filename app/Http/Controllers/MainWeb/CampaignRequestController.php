<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Actions\MainWeb\CampaignRequestAction;
class CampaignRequestController extends Controller
{
    //
    private $campaignRequest;
    public function __construct(CampaignRequestAction $campaignRequest)
    {
        $this->campaignRequest=$campaignRequest;
    }

    public function getView(): View
    {
        return view('dashboard.main-web.campaignrequest');
    }
    public function getAllRequests()
    {
        $campaignReq = $this->campaignRequest->getData();
        return $campaignReq;
    }
    public function deleteRequest(Request $request)
    {
        $campaignReq=$this->campaignRequest->deleteRequest($request);
        return $campaignReq;
    }
    public function updateRequestStatus(Request $request,$id)
    {
        $campaignReq = $this->campaignRequest->updateDataStatus($request,$id);
        return $campaignReq;
    }

}
