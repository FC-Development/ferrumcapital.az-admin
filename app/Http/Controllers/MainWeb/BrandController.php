<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Actions\MainWeb\BrandAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainWeb\StoreBrandRequest;

class BrandController extends Controller
{
    //
    
    public function brandPage()
    {
        return view('dashboard.main-web.brand');
    }
    public function getBrand()
    {
        $response = new BrandAction();
        return $response->getData();
    }
    public function postBrand(StoreBrandRequest $request)
    {
        $postBrand = new BrandAction(); 
        $brand= $postBrand->postData($request);
        return response($brand);
    }
    public function deleteBrand(Request $request)
    {
        
      $deletedBrand = new BrandAction();
      $brand = $deletedBrand->deleteData($request);
      return response($brand);
    }
    public function findBrand(Request $request)
    {
        $findBrand = new BrandAction();
        $brand = $findBrand->findData($request);
        return response($brand);
    }
    public function updateBrandStatus(Request $request,$id)
    {
        $statusBrand = new BrandAction();
         $brand=$statusBrand->updateDataStatus($request,$id);
         return response($brand);
    }
    public function updateBrand(StoreBrandRequest $request)
    {
        $updateBrand = new BrandAction();
        $brand = $updateBrand->updateData($request);
        return response($brand);
    }
}
