<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Actions\MainWeb\CampaignsAction;
use App\Models\Campaigns;
use Exception;
use Illuminate\Support\Facades\DB;

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

    // public function postBlog(StoreBlogRequest $request)
    // {
    //     $postBlog = new BlogAction(); 
    //     $blog = $postBlog->postData($request);
    //     return response($blog);
    // }

    // public function deleteBlog(Request $request)
    // {
        
    //   $deletedBlog = new BlogAction();
    //   $blog = $deletedBlog->deleteData($request);
    //   return response($blog);
    // }

    // public function findBlog(Request $request)
    // {
    //     $findBlog = new BlogAction;
    //     $blog = $findBlog->findData($request);
    //     return response($blog);
    // }

    // public function updateBlogStatus(Request $request,$id)
    // {
    //     $statusBlog = new BlogAction();
    //      $blog=$statusBlog->updateDataStatus($request,$id);
    //      return response($blog);
    // }

    // public function updateBlog(StoreBlogRequest $request)
    // {
    //     $updateBlog = new BlogAction();
    //     $blog = $updateBlog->updateData($request);
    //     return response("Success",200);
    // }
}
