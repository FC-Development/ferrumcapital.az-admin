<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use \App\Actions\MainWeb\CategoriesAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MainWeb\CategoriesRequest;

class CategoriesController extends Controller
{
    public function CategoriesPage()
    {
        return view('dashboard.main-web.categories');
    }
    public function getCategories()
    {
        $response = new CategoriesAction();
        return $response->getData();
    }
    public function postCategories(CategoriesRequest $request)
    {
        $postCategories = new CategoriesAction(); 
        $categories = $postCategories->postData($request);
        return response($categories);
    }
    public function deleteCategories(Request $request)
    {
        
      $deletedCategories = new CategoriesAction();
      $categories = $deletedCategories->deleteData($request);
      return response($categories);
    }
    public function findCategories(Request $request)
    {
        $findCategories = new CategoriesAction;
        $categories = $findCategories->findData($request);
        return response($categories);
    }
    public function updateCategoriesStatus(Request $request,$id)
    {
        $statusCategories = new CategoriesAction();
         $categories=$statusCategories->updateDataStatus($request,$id);
         return response($categories);
    }
    public function updateCategories(CategoriesRequest $request)
    {
        $updateCategories = new CategoriesAction();
        $categories = $updateCategories->updateData($request);
        return response("Success",200);
    }
}
