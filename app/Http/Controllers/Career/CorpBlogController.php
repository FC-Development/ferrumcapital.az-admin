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
        $blog = $this->blog->postData($request);
        return ($blog);
    }
    public function deleteBlog(Request $request)
    {

      $blog = $this->blog->deleteData($request);
      return ($blog);
    }
    public function findBlog(Request $request)
    {
        $blog = $this->blog->findData($request);
        return ($blog);
    }
    public function updateBlogStatus(Request $request,$id)
    {
         $blog=$this->blog->updateDataStatus($request,$id);
         return ($blog);
    }
    public function updateBlog(StoreBlogRequest $request)
    {
        $blog = $this->blog->updateData($request);
        return $blog;
    }
}
