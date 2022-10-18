<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BrandSecActions extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector");
                 if(!isset($response['msg']))
                 {   
                        $res_arr=[];
                               foreach((\json_decode($response,true)) as $key => $value)
                               {
                                      $tmp__ = [
                                             'uniq_id' => $value['uniq_id'],
                                             'title_az' => \json_decode($value['title'],true)['az'],
                                             'title_en' => \json_decode($value['title'],true)['en'],
                                             'cover' => ($value['cover']),
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector",[
                     'uniq_id' => Str::random(9),
                     'title' => \json_encode(['az'=>$request->input('title_az'),'en' =>$request->input('title_en')]),
                     'cover' =>$this->uploadAvatar($request,'cover','','brand_sector'),
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                            foreach((\json_decode($get_data,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'title_az' => \json_decode($value['title'],true)['az'],
                                          'title_en' => \json_decode($value['title'],true)['en'],
                                          'cover' => ($value['cover']),
                                   ];
                                   array_push($res_arr,$tmp__);
                            }
                            return $res_arr;
              }
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              if($get_data[0]['cover']!="") {
                     $cover__ = explode("/",$get_data[0]['cover'])[4];
                     Storage::disk('s3')->delete('brand_sector/'.$cover__);
              }
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector/".$id);
              return response($response->json()); 
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector/?where=(uniq_id,like,".$uniq_id.")");
              var_dump($get_data->body());
              $id = $get_data[0]['id'];
              $updatedImage = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'brand_sector');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/brand_sector/$id",[
                     'title' => \json_encode(['az'=>$request->input('title_az'),'en' =>$request->input('title_en')]),
                     'cover' => $updatedImage
              ]);
       }
       public function updateDataStatus(Request $request, $id)
       {

       }
}