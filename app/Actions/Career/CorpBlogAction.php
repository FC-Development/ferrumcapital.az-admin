<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerBlogs;
class CorpBlogAction extends AdminMethods
{
       private CareerBlogs $careerBlogs;
       public function __construct(CareerBlogs $careerBlogs)
       {
           $this->careerBlogs = $careerBlogs;
       }

    public function getData()
       {
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


       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog",[
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
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/?where=(uniq_id,like,".$uniq_id.")");
              return $get_data;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              $include__ = $get_data[0]['include_image'] ? explode("/",$get_data[0]['include_image'])[2]: '';
              $cover__ = $get_data[0]['cover'] ? explode("/",$get_data[0]['cover'])[2] : '';
              $include__!='' ?: Storage::disk('s3')->delete("career_blog/".$cover__);
              $cover__ != '' ?: Storage::disk('s3')->delete("career_blog/".$include__);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/".$id);
              return response($response->json());
       }
       public function updateDataStatus(Request $request,$id)
       {
              $tmp_arr_ = array(
                     "response" =>"",
                     "state" => true
                 );
                 $response = Http::withHeaders([
                     'xc-auth' => \env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
                 $tmp_arr_['response'] = $last_res->json();
                 return response(200);
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');

              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $updatedCover = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'career_blog');
              $updatedInclude = $this->uploadAvatar($request,'include_image',$get_data[0]['include_image'],'career_blog');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")]
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_blog/$id",[
                     'title' => $request['title'],
                     'tips_text' => $request['tips_text'],
                     'cover' => $updatedCover,
                     'blog_body' => $request['blog_body_edit'],
                     'language' => $request['blog_lang'],
                     'meta_description' => $request['meta_description'],
                     'include_image' => $updatedInclude
              ]);

              return $response;
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
