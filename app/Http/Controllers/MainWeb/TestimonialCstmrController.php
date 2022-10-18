<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\TestimonialCstmrAction;
use App\Http\Requests\MainWeb\StoreTestmnlCstmrRequest;

class TestimonialCstmrController extends Controller
{
    //
    public function testimonialPage()
    {
        return view('dashboard.main-web.testimonialCstmr');
    }
    public function getTestimonial()
    {
        $response = new TestimonialCstmrAction();
        return $response->getData();
    }
    public function postTestimonial(StoreTestmnlCstmrRequest $request)
    {
        $postBlog = new TestimonialCstmrAction(); 
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function updateTestimonial(StoreTestmnlCstmrRequest $request)
    {
        $updateBlog = new TestimonialCstmrAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
    public function deleteTestimonial(Request $request)
    {
        
      $deletedBlog = new TestimonialCstmrAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findTestimonial(Request $request)
    {
        $findBlog = new TestimonialCstmrAction();
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateTestimonialStatus(Request $request,$id)
    {
        $statusBlog = new TestimonialCstmrAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
}
