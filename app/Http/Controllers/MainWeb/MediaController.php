<?php

namespace App\Http\Controllers\MainWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\MediaAction;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\StoreMediaRequest;

class MediaController extends Controller
{
    //
    public function mediaPage()
    {
        return view('dashboard.main-web.media');
    }
    public function getMedia()
    {
        $response = new MediaAction();
        return $response->getData();
    }
    public function postMedia(StoreMediaRequest $request)
    {
        $postBlog = new MediaAction(); 
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function deleteMedia(Request $request)
    {
        
      $deletedBlog = new MediaAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findMedia(Request $request)
    {
        $findBlog = new MediaAction;
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateMediaStatus(Request $request,$id)
    {
        $statusBlog = new MediaAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
    public function updateMedia(StoreMediaRequest $request)
    {
        $updateBlog = new MediaAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
}
