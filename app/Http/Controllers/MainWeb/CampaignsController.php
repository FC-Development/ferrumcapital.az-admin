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
    public function campaignsPage()
    {
        return view('dashboard.main-web.campaigns');
    }
    public function getCampaigns()
    {
        $response = new CampaignsAction();
        return $response->getData();
    }

    public function postCampaign(StoreCampaignsRequest $request)
    {
        $postCampaign = new CampaignsAction(); 
        $campaignRes = $postCampaign->postData($request);
        return response($campaignRes);
    }

    public function deleteCampaign(Request $request, $uniq_id)
    {
        $deletedCampaign = new CampaignsAction();
        $campaignRes = $deletedCampaign->deleteData($request);
        return response($campaignRes);
    }
}
