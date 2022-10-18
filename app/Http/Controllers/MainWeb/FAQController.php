<?php

namespace App\Http\Controllers\MainWeb;

use App\Actions\MainWeb\FAQAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainWeb\StoreFaqRequest;

class FAQController extends Controller
{
    public function faqPage()
    {
        return view('dashboard.main-web.faq');
    }
    public function updateFaq(StoreFaqRequest $request)
    {
        $updateFaq = new FAQAction();
        $blog = $updateFaq->updateData($request);
        return response("Success",200);
    }
    public function getFaq()
    {
        $response = new FAQAction();
        return $response->getData();
    }
    public function postFaq(StoreFaqRequest $request)
    {
        $postFaq = new FAQAction(); 
        $faq = $postFaq->postData($request);
        return response($faq);
    }
    public function deleteFaq(Request $request)
    {
      $deletedFaq = new FAQAction();
      $faq = $deletedFaq->deleteData($request);
      return response($faq);
    }
    public function findFaq(Request $request)
    {
        $findFaq = new FAQAction();
        $faq = $findFaq->findData($request);
        return response($faq);
    }
}
