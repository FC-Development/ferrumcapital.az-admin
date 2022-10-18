<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\GuidesAction;
use App\Http\Requests\MainWeb\StoreGuideRequest;

class GuidesController extends Controller
{
    //
    public function guidePage()
    {
        return view('dashboard.main-web.guide');
    }
    public function getGuides()
    {
        $response = new GuidesAction();
        return $response->getData();
    }
    public function postGuides(StoreGuideRequest $request)
    {
        $postBlog = new GuidesAction(); 
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function deleteGuides(Request $request)
    {
      $deletedBlog = new GuidesAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findGuides(Request $request)
    {
        $findGuide = new GuidesAction;
        $guide = $findGuide->findData($request);
        return response($guide);
    }
    public function updateGuideStatus(Request $request,$id)
    {
        $statusBlog = new GuidesAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
    public function updateGuide(StoreGuideRequest $request)
    {
        $updateBlog = new GuidesAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
}
