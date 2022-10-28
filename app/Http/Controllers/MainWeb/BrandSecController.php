<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\MainWeb\BrandSecActions;
use App\Http\Requests\MainWeb\StoreBrandSecRequest;

class BrandSecController extends Controller
{
    //
    public function brandSecPage()
    {
        return view('dashboard.main-web.brandsec');
    }
    public function getBrandSec()
    {
        $response = new BrandSecActions();
        $data= $response->getData();
        return $data;
    }
    public function postBrandSec(StoreBrandSecRequest $request)
    {
        $postBrand = new BrandSecActions();
        $brand = $postBrand->postData($request);
        return response($brand);
    }
    public function deleteBrandSec(Request $request)
    {
        $deletedData = new BrandSecActions();
        $data = $deletedData->deleteData($request);
        return response($data);
    }
    public function findBrandSec(Request $request)
    {
        $findData  = new BrandSecActions();
        $data = $findData->findData($request);
        return response($data);
    }
    public function updateBrandSec(StoreBrandSecRequest $request)
    {
        $updateData = new BrandSecActions();
        $data = $updateData->updateData($request);
        return response("Success",200);
    }
}
