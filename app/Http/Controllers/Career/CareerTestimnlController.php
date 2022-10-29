<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\TestimonialAction;
use App\Http\Requests\Career\StoreCareerTestmnl;
class CareerTestimnlController extends Controller
{
    //
    private $testimonial;
    public function __construct(TestimonialAction $testimonial)
    {
        $this->testimonial=$testimonial;
    }

    public function testimonialPage()
    {
        return view('dashboard.career.testimonial');
    }
    public function getTestimonial()
    {
        $response = $this->testimonial->getData();
        return $response;
    }
    public function postTestimonial(StoreCareerTestmnl $request)
    {
        $testimonial = $this->testimonial->postData($request);
        return response($testimonial);
    }
    public function updateTestimonial(StoreCareerTestmnl $request)
    {
        $testimonial = $this->testimonial->updateData($request);
        return $testimonial;
    }
    public function deleteTestimonial(Request $request)
    {

        $testimonial = $this->testimonial->deleteData($request);
      return ($testimonial);
    }
    public function findTestimonial(Request $request)
    {
        $testimonial = $this->testimonial->findData($request);
        return ($testimonial);
    }
    public function updateTestimonialStatus(Request $request,$id)
    {
        $testimonial=$this->testimonial->updateDataStatus($request,$id);
         return ($testimonial);
    }
}
