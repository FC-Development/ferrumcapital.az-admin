<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Throwable;

class MediaAction extends AdminMethods
{
       protected $time;

       public function getData()
       {
              try {
                     $response = Media::all();
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'title' => $value['title'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'cover' => "",
                                   'incl_img' => "",
                                   'tips_txt' => $value['tips_text'],
                                   'status' => $value['status'],
                                   'media_lang' => $value['language'],
                                   'meta_description' => $value['meta_description']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              } catch(Throwable $e) {
                     return response("Error",404);
              }
             
              

       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media",[
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'media_body' => $request->input('media_body'),
                     'title' => $request->input('title'),
                     'cover' =>"",
                     'include_image' =>"",
                     'tips_text' => $request->input('tips_text'),
                  'slug'=>$this->slugOlustur($request->input('title')),
                  'section' => 'media',
                  'language' => $request->input('media_lang'),
                  'meta_description' => $request->input('meta_description')
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/?where=(uniq_id,like,".$uniq_id.")");
              return $get_data;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              Storage::disk('main')->delete($get_data[0]['cover']);
              Storage::disk('main')->delete($get_data[0]['include_image']);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/".$id);
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
                 $tmp_arr_['response'] = $last_res->json();
                 return response(200);
       }
       public function updateData(Request $request)
       {
              $data = $request->validate([
                     'title' => 'min:3',
                     'media_body_edit' => 'min:3',
                     'tips_text' => 'min:3',
                     
              ]);
              $uniq_id = $request->input('uniq_id');

              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")]
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/media/$id",[
                     'title' => $data['title'],
                     'tips_text' => $data['tips_text'],
                     'cover' => "",
                     'media_body' => $data['media_body_edit'],
                     'include_image' => "",
                     "language" => $request->input('media_lang'),
                     'meta_description' => $request->input('meta_description')
              ]);

              return $response;
       }
}
