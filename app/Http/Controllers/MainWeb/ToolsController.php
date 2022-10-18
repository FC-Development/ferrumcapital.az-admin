<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Actions\MainWeb\ToolsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainWeb\StoreToolsRequest;

class ToolsController extends Controller
{
    public function toolsPage()
    {
        return view('dashboard.main-web.tool');
    }
    public function getTools()
    {
        $response = new ToolsAction();
        return $response->getData();
    }
    public function postTools(StoreToolsRequest $request)
    {
        $postBlog = new ToolsAction(); 
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function deleteTools(Request $request)
    {
      $deletedBlog = new ToolsAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findTools(Request $request)
    {
        $findBlog = new ToolsAction;
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateToolStatus(Request $request,$id)
    {
        $statusBlog = new ToolsAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
    public function updateTools(StoreToolsRequest $request)
    {
        $updateBlog = new ToolsAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
}
