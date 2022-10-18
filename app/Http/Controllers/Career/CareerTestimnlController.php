<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\TestimonialAction;
use App\Http\Requests\Career\StoreCareerTestmnl;
class CareerTestimnlController extends Controller
{
    //
    public function testimonialPage()
    {
        return view('dashboard.career.testimonial');
    }
    public function getTestimonial()
    {
        $response = new TestimonialAction();
        return $response->getData();
    }
    public function postTestimonial(StoreCareerTestmnl $request)
    {
        $postBlog = new TestimonialAction(); 
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function updateTestimonial(StoreCareerTestmnl $request)
    {
        $updateBlog = new TestimonialAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
    public function deleteTestimonial(Request $request)
    {
        
      $deletedBlog = new TestimonialAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findTestimonial(Request $request)
    {
        $findBlog = new TestimonialAction();
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateTestimonialStatus(Request $request,$id)
    {
        $statusBlog = new TestimonialAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
}
