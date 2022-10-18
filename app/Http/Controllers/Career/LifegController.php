<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Career\LifegAction;
use App\Http\Requests\Career\StoreLifegRequest;
class LifegController extends Controller
{
    //
    public function lifePage()
    {
        return view('dashboard.career.lifegallery');
    }
    public function getLifeG()
    {
        $response = new LifegAction();
        return $response->getData();
    }
    public function postLifeG(StoreLifegRequest $request)
    {
        $postGallery = new LifegAction(); 
        $gallery = $postGallery->postData($request);
        return response($gallery);
    }
    public function deleteLifeG(Request $request)
    {
        
      $deletedGallery = new LifegAction();
      $gallery = $deletedGallery->deleteData($request);
      return response($gallery);
    }
}
