<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerBlogs;
use mysql_xdevapi\Exception;

class CorpBlogAction extends AdminMethods
{
       private CareerBlogs $careerBlogs;
       public function __construct(CareerBlogs $careerBlogs)
       {
           $this->careerBlogs = $careerBlogs;
       }

    public function getData()
       {
           try {
               $response = $this->careerBlogs->all();
               $res_arr=[];
               foreach((\json_decode($response,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'blog_body' => $value['blog_body'],
                       'title' => $value['title'],
                       'create_time' => ($value['created_at']),
                       'cover' => $value['cover'],
                       'incl_img' => $value['include_image'],
                       'tips_txt' => $value['tips_text'],
                       'status' => $value['status'],
                       'blog_lang' => $value['language'],
                       'meta_description' => $value['meta_description']
                   ];
                   array_push($res_arr,$tmp__);
               }
               return response()->json($res_arr);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }



       }
       public function postData(Request $request)
       {
           try {
               $response= $this->careerBlogs->create([
                   'uniq_id' => Str::random(6),
                   'status' => 'active',
                   'blog_body' => $request->input('blog_body'),
                   'title' => $request->input('title'),
                   'cover' =>$this->uploadAvatar($request,'cover','','career_blog'),
                   'include_image' =>$this->uploadAvatar($request,'include_image','','career_blog'),
                   'tips_text' => $request->input('tips_text'),
                   'slug' => $this->slugOlustur($request->input('title')),
                   'section' => 'blog',
                   'language' => $request->input('blog_lang'),
                   'meta_description' => $request->input('meta_description')
               ]);
               return response()->json($response);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = $this->careerBlogs->where("uniq_id",$uniq_id)->get();
               return response()->json($get_data);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');
               $get_data=$this->careerBlogs->where("uniq_id",$uniq_id)->get();
               $id=$get_data[0]['id'];
               $include__ = $get_data[0]['include_image'] ? explode("/",$get_data[0]['include_image'])[2]: '';
               $cover__ = $get_data[0]['cover'] ? explode("/",$get_data[0]['cover'])[2] : '';
               $include__!='' ?: Storage::disk('s3')->delete("career_blog/".$cover__);
               $cover__ != '' ?: Storage::disk('s3')->delete("career_blog/".$include__);
               $response=$this->careerBlogs->where("uniq_id",$uniq_id)->delete();
               return response()->json($response);
           } catch (\Throwable $e) {
               throw new Exception($e);
           }

       }
       public function updateDataStatus(Request $request,$id)
       {

           try {
               $this->careerBlogs->where("uniq_id",$id)->update([
                   "status" => $request->input('status')
               ]);
               return response(200);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function updateData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');

               $get_data = $this->careerBlogs->where("uniq_id",$uniq_id)->get();
               $id = $get_data[0]['id'];
               $updatedCover = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'career_blog');
               $updatedInclude = $this->uploadAvatar($request,'include_image',$get_data[0]['include_image'],'career_blog');
               $response = $this->careerBlogs->where("uniq_id",$uniq_id)->update([
                   'title' => $request['title'],
                   'tips_text' => $request['tips_text'],
                   'cover' => $updatedCover,
                   'blog_body' => $request['blog_body_edit'],
                   'language' => $request['blog_lang'],
                   'meta_description' => $request['meta_description'],
                   'include_image' => $updatedInclude
               ]);

               return response()->json("Updated",200);
           } catch (\Throwable $e) {
               throw new Exception($e);
           }

       }

       public function findDataByUniqId($uniq_id)
       {
        $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'blog_body' => $value['blog_body'],
                                   'title' => $value['title'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'cover' => $value['cover'],
                                   'incl_img' => $value['include_image'],
                                   'tips_txt' => $value['tips_text'],
                                   'status' => $value['status'],
                                   'meta_description' => $value['meta_description'],
                                   'blog_lang' => $value['language']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }
       }
}
