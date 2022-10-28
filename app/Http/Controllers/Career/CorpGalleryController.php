<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Career\StoreCorpGalRequest;
use App\Actions\Career\CorpGaleryAction;
class CorpGalleryController extends Controller
{
    //
    private $gallery;
    public function __construct(CorpGaleryAction $gallery)
    {
        $this->gallery= $gallery;
    }

    public function galleryPage()
    {
        return view('dashboard.career.corpgallery');
    }
    public function getCorpGal()
    {
        $response = $this->gallery->getData();
        return $response;
    }
    public function postCorpGal(StoreCorpGalRequest $request)
    {
        $gallery = $this->gallery->postData($request);
        return ($gallery);
    }
    public function deleteCorpGal(Request $request)
    {
      $gallery = $this->gallery->deleteData($request);
      return ($gallery);
    }
}
