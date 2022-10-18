<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GuidesAction extends AdminMethods
{
       protected $time;
       public function getData()
       {       
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides");
              if(!isset($response['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'cover' => $value['cover'],
                                   'file_upload' => $value['file_upload'],
                                   'status' => $value['status'],
                                   'title' => $value['title']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return response($res_arr);
              }
              
       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides",[
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'file_upload' => $this->uploadAvatar($request,'file_upload','','guides'),
                     'cover' =>$this->uploadAvatar($request,'cover','','guides'),
                     'title' => $request->input('title')
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/?where=(uniq_id,like,".$uniq_id.")");
              return $get_data;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              $cover__ = explode('/',$get_data[0]['cover'])[4];
              $file__ = explode("/",$get_data[0]['file_upload'])[4];
              Storage::disk('main')->delete('guides/'.$cover__);
              Storage::disk('main')->delete("guides/".$file__);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/".$id);
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
                 $tmp_arr_['response'] = $last_res->json();
                 return response(200);
       }
       public function updateData(Request $request)
       {
              $data = $request->validate([
                     'title' => 'required|min:3',
                     'cover' => 'mimes:png,jpg,jpeg',
                     'file_upload' => 'mimes:png,jpg,jpeg,pdf,svg',
              ]);
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $updatedCover = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'guides');
              $updatedFile = $this->uploadAvatar($request,'file_upload',$get_data[0]['file_upload'],'guides');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/guides/$id",[
                     'cover' => $updatedCover,
                     'file_upload' =>$updatedFile,
                     'title' => $data['title']
              ]);
              return $response;
       }
}