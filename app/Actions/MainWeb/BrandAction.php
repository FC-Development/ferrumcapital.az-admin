<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BrandAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands?limit=199");
              
                 
              if(!isset($response['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'adress' => $value['adress'],
                                   'city' => $value['city'],
                                   'ig' => \json_decode($value['links'],true)['ig'],
                                   'fb' => \json_decode($value['links'],true)['fb'],
                                   'logo' => $value['logo'],
                                   'name' => $value['name'],
                                   'phone' => $value['phone'],
                                   'status' => $value['status'],
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;

              }
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'adress' => $value['adress'],
                                   'city' => $value['city'],
                                   'sector_id' => $value['sector_id'],
                                   'ig' => \json_decode($value['links'],true)['ig'],
                                   'fb' => \json_decode($value['links'],true)['fb'],
                                   'logo' => $value['logo'],
                                   'name' => $value['name'],
                                   'phone' => $value['phone'],
                                   'status' => $value['status']
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands",[
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'name' => $request->input('name'),
                     'phone' => $request->input('phone'),
                     'adress' => $request->input('adress'),
                     'sector_id' => $request->input('sector_id'),
                     'city' => $request->input('city'),
                     'logo' =>$this->uploadAvatar($request,'logo','','brand_logo'),
                     'links' => \json_encode(['ig' => $request->input('ig'),'fb' => $request->input('fb')])
              ]);
              return $response;
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $updatedLogo = $this->uploadAvatar($request,'logo',$get_data[0]['logo'],'brand_logo');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/$id",[
                     'name' => $request['name'],
                     'sector_id' => $request['sector_id'],
                     'phone' => $request['phone'],
                     'adress' => $request['adress'],
                     'links' =>\json_encode(['ig' => $request->input('ig'),'fb' => $request->input('fb')]),
                     'city' => $request['city'],
                     'logo' => $updatedLogo
              ]);

              return $response;
       }
       public function updateDataStatus(Request $request, $id)
       {
              $tmp_arr_ = array(
                     "response" =>"",
                     "state" => true
                 );
                 $response = Http::withHeaders([
                     'xc-auth' => \env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
                 $tmp_arr_['response'] = $last_res->json();
                 return response(200);
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              $logo__ = explode("/",$get_data[0]['logo'])[4];
              Storage::disk('s3')->delete("brand_logo".$logo__);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brands/".$id);
              return response($response->json()); 
       }
}