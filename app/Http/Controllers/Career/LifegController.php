<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\LifegAction;
use App\Http\Requests\Career\StoreLifegRequest;
class LifegController extends Controller
{
    //
    private $lifeGallery;
    public function __construct(LifegAction $lifeGallery)
    {
        $this->lifeGallery = $lifeGallery;
    }

    public function lifePage()
    {
        return view('dashboard.career.lifegallery');
    }
    public function getLifeG()
    {
        $response = $this->lifeGallery->getData();
        return $response;
    }
    public function postLifeG(StoreLifegRequest $request)
    {
        $gallery = $this->lifeGallery->postData($request);
        return ($gallery);
    }
    public function deleteLifeG(Request $request)
    {

      $gallery = $this->lifeGallery->deleteData($request);
      return ($gallery);
    }
}
