<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Career\StoreCorpGalRequest;
use App\Actions\Career\CorpGaleryAction;
class CorpGalleryController extends Controller
{
    //
    public function galleryPage()
    {
        return view('dashboard.career.corpgallery');
    }
    public function getCorpGal()
    {
        $response = new CorpGaleryAction();
        return $response->getData();
    }
    public function postCorpGal(StoreCorpGalRequest $request)
    {
        $postGallery = new CorpGaleryAction(); 
        $gallery = $postGallery->postData($request);
        return response($gallery);
    }
    public function deleteCorpGal(Request $request)
    {
      $deletedGallery = new CorpGaleryAction();
      $gallery = $deletedGallery->deleteData($request);
      return response($gallery);
    }
}
