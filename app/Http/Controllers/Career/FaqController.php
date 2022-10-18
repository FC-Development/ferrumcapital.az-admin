<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\CareerFaqAction;
use App\Http\Requests\MainWeb\StoreFaqRequest;
class FaqController extends Controller
{
    //
    public function faqPage()
    {
        return view('dashboard.career.faq');
    }
    public function updateFaq(StoreFaqRequest $request)
    {
        $updateFaq = new CareerFaqAction();
        $blog = $updateFaq->updateData($request);
        return response("Success",200);
    }
    public function getFaq()
    {
        $response = new CareerFaqAction();
        return $response->getData();
    }
    public function postFaq(StoreFaqRequest $request)
    {
        $postFaq = new CareerFaqAction(); 
        $faq = $postFaq->postData($request);
        return response($faq);
    }
    public function deleteFaq(Request $request)
    {
      $deletedFaq = new CareerFaqAction();
      $faq = $deletedFaq->deleteData($request);
      return response($faq);
    }
    public function findFaq(Request $request)
    {
        $findFaq = new CareerFaqAction();
        $faq = $findFaq->findData($request);
        return response($faq);
    }
}
