<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class BlogAction extends AdminMethods
{
       protected $time;
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost");
              if(!isset($response['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'title' => $value['title'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'cover' => $value['cover'],
                                   'incl_img' => $value['include_image'],
                                   'tips_text' => $value['tips_text'],
                                   'status' => $value['status'],
                                   'blog_body' => $value['blog_body'],
                                   'blog_lang' => $value['language'],
                                   'meta_description' => $value['meta_description']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }

       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost",[
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'blog_body' => $request->input('blog_body'),
                     'title' => $request->input('title'),
                     'cover' =>$this->uploadAvatar($request,'cover','','main_blog'),
                     'include_image' =>$this->uploadAvatar($request,'include_image','','main_blog'),
                     'tips_text' => $request->input('tips_text'),
                     'slug' => $this->slugOlustur($request->input('title')),
                     'section'=>'blog',
                     "language" => $request->input('blog_lang'),
                     'meta_description' => $request->input('meta_description')
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/?where=(uniq_id,like,".$uniq_id.")");
              return $get_data;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              
              $cover__ = explode('/',$get_data[0]['cover'])[4];
              $include__ = explode('/',$get_data[0]['include_image'])[4];
              Storage::disk('s3')->delete("main_blog/".$cover__);
              Storage::disk('s3')->delete("main_blog/".$include__);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/".$id);
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/'.$response[0]['id'], [
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $updatedCover = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'main_blog');
              $updatedInclude = $this->uploadAvatar($request,'include_image',$get_data[0]['include_image'],'main_blog');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")]
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/$id",[
                     'title' => $request['title'],
                     'tips_text' => $request['tips_text'],
                     'cover' => $updatedCover,
                     'blog_body' => $request['blog_body_edit'],
                     'include_image' => $updatedInclude,
                     'language' => $request['blog_lang'],
                     'meta_description' => $request['meta_description']
              ]);

              return $response;
       }

       public function findDataByUniqId($uniq_id)
       {
        $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/blogpost/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'title' => $value['title'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'cover' => $value['cover'],
                                   'incl_img' => $value['include_image'],
                                   'tips_text' => $value['tips_text'],
                                   'status' => $value['status'],
                                   'blog_body' => $value['blog_body'],
                                   'blog_lang' => $value['language'],
                                   'meta_description' => $value['meta_description']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }
       }

    //    public function Paginate()
    //    {
    //           $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
    //           ->get('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(title,like,"%'.$title.'%")');
    //           return $get_data;
    //    }
}
