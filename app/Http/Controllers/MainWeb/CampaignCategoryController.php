<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use \App\Actions\MainWeb\CampaignCategoryAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\CampaignCategoryRequest;

class CampaignCategoryController extends Controller
{
    public function CampaignCategoryPage()
    {
        return view('dashboard.main-web.campaign-category');
    }
    public function getCampaignCategory()
    {
        $response = new CampaignCategoryAction();
        return $response->getData();
    }
    public function postCampaignCategory(CampaignCategoryRequest $request)
    {
        $postCampaignCategory = new CampaignCategoryAction(); 
        $campaignCategory = $postCampaignCategory->postData($request);
        return response($campaignCategory);
    }
    public function deleteCampaignCategory(Request $request)
    {
        
      $deletedCampaignCategory = new CampaignCategoryAction();
      $campaignCategory = $deletedCampaignCategory->deleteData($request);
      return response($campaignCategory);
    }
    public function findCampaignCategory(Request $request)
    {
        $findCampaignCategory = new CampaignCategoryAction;
        $campaignCategory = $findCampaignCategory->findData($request);
        return response($campaignCategory);
    }
    public function updateCampaignCategoryStatus(Request $request,$id)
    {
        $statusCampaignCategory = new CampaignCategoryAction();
         $campaignCategory=$statusCampaignCategory->updateDataStatus($request,$id);
         return response($campaignCategory);
    }
    public function updateCampaignCategory(CampaignCategoryRequest $request)
    {
        $updateCampaignCategory = new CampaignCategoryAction();
        $campaignCategory = $updateCampaignCategory->updateData($request);
        return response("Success",200);
    }
}
