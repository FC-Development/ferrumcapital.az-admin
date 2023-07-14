<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use \App\Actions\MainWeb\BlogAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\StoreBlogRequest;

class PopularPartnersController extends Controller
{
    public function popularPartnersPage()
    {
        return view('dashboard.main-web.popular-partners');
    }
    // public function getBlog()
    // {
    //     $response = new BlogAction();
    //     return $response->getData();
    // }
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
