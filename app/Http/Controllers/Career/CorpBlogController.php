<?php

namespace App\Http\Controllers\Career;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Career\CorpBlogAction;
use App\Http\Requests\Career\StoreBlogRequest;

class CorpBlogController extends Controller
{
    //
    private $blog;
    public function __construct(CorpBlogAction $blog)
    {
        $this->blog = $blog;
    }

    public function blogPage()
    {
        return view('dashboard.career.blog');
    }
    public function getBlog()
    {
        $response = $this->blog->getData();
        return $response;
    }
    public function postBlog(StoreBlogRequest $request)
    {
        $postBlog = new CorpBlogAction();
        $blog = $postBlog->postData($request);
        return response($blog);
    }
    public function deleteBlog(Request $request)
    {

      $deletedBlog = new CorpBlogAction();
      $blog = $deletedBlog->deleteData($request);
      return response($blog);
    }
    public function findBlog(Request $request)
    {
        $findBlog = new CorpBlogAction;
        $blog = $findBlog->findData($request);
        return response($blog);
    }
    public function updateBlogStatus(Request $request,$id)
    {
        $statusBlog = new CorpBlogAction();
         $blog=$statusBlog->updateDataStatus($request,$id);
         return response($blog);
    }
    public function updateBlog(StoreBlogRequest $request)
    {
        $updateBlog = new CorpBlogAction();
        $blog = $updateBlog->updateData($request);
        return response("Success",200);
    }
}
