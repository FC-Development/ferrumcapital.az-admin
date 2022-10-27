<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CampaignsAction extends AdminMethods
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
}
