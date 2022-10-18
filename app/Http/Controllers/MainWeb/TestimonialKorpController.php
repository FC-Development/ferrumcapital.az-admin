<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\TestimonialKorpAction;
use App\Http\Requests\MainWeb\StoreTestmnlKorpRequest;

class TestimonialKorpController extends Controller
{
    //
    public function testimonialPage()
    {
        return view('dashboard.main-web.testimonialKorp');
    }
    public function getTestimonial()
    {
        $response = new TestimonialKorpAction();
        return $response->getData();
    }
    public function postTestimonial(StoreTestmnlKorpRequest $request)
    {
        $postBlog = new TestimonialKorpAction();
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function updateTestimonial(StoreTestmnlKorpRequest $request)
    {
        $update = new TestimonialKorpAction();
        $blog = $update->updateData($request);
        return response($blog);
    }
    public function deleteTestimonial(Request $request)
    {

      $deletedBlog = new TestimonialKorpAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findTestimonial(Request $request)
    {
        $findBlog = new TestimonialKorpAction();
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateTestimonialStatus(Request $request,$id)
    {
        $statusBlog = new TestimonialKorpAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }

}
