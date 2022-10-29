<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\CareerFaqAction;
use App\Http\Requests\MainWeb\StoreFaqRequest;
class FaqController extends Controller
{
    private $careerFaq;
    public function __construct(CareerFaqAction $careerFaq)
    {
        $this->careerFaq = $careerFaq;
    }

    //
    public function faqPage()
    {
        return view('dashboard.career.faq');
    }
    public function updateFaq(StoreFaqRequest $request)
    {
        $blog = $this->careerFaq->updateData($request);
        return $blog;
    }
    public function getFaq()
    {
        $response = $this->careerFaq->getData();
        return $response;
    }
    public function postFaq(StoreFaqRequest $request)
    {
        $faq = $this->careerFaq->postData($request);
        return ($faq);
    }
    public function deleteFaq(Request $request)
    {
      $faq = $this->careerFaq->deleteData($request);
      return ($faq);
    }
    public function findFaq(Request $request)
    {
        $faq = $this->careerFaq->findData($request);
        return ($faq);
    }
}
