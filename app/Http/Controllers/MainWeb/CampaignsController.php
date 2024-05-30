<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Actions\MainWeb\CampaignsAction;
use App\Models\Campaigns;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MainWeb\StoreCampaignsRequest;


class CampaignsController extends Controller
{
    private $campaigns;
    public function __construct(CampaignsAction $campaigns)
    {
        $this->campaigns = $campaigns;
    }

    public function campaignsPage()
    {
        return view('dashboard.main-web.campaigns');
    }
    public function getCampaigns()
    {
        $response = $this->campaigns->getData();
        return $response;
    }

    public function postCampaign(StoreCampaignsRequest $request)
    {
        $campaignRes = $this->campaigns->postData($request);
        return ($campaignRes);
    }

    public function deleteCampaign(Request $request, $uniq_id)
    {
        $campaignRes = $this->campaigns->deleteData($request);
        return response($campaignRes);
    }
    public function updateCampaignStatus(Request $request,$id)
    {
        $campaignRes= $this->campaigns->updateDataStatus($request,$id);
        return $campaignRes;
    }
    public function updateCampaign(Request $request)
    {
        $campaignRes= $this->campaigns->updateData($request);
        return $campaignRes;
    }
    public function findCampaign(Request $request)
    {
        $campaignRes=$this->campaigns->findData($request);
        return $campaignRes;
    }
    public function getPartnerList()
    {
        $res = DB::table('nc_1gn9__our_partners')->get();
        return response($res);
    }
}
