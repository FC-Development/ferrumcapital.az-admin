<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BfStatisticAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic");
              if(!isset($response['msg']))
              {   
                     $res_arr=[];
                            foreach((\json_decode($response,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'header_az' => \json_decode($value['header'],true)['az'],
                                          'header_en' => \json_decode($value['header'],true)['en'],
                                          'value' => ($value['value']),
                                          'category_az' =>\json_decode($value['category'],true)['az'],
                                          'category_en' => \json_decode($value['category'],true)['en'],
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic",[
                     'uniq_id' => Str::random(6),
                     'header' => json_encode(['az'=> $request->input('header_az'),'en' => $request->input('header_en')]) ,
                     'value' => $request->input('value'),
                     'category' => \json_encode(['az'=>$request->input('category_az'),'en' => $request->input('category_en')]) ,
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                            foreach((\json_decode($get_data,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'header_az' => \json_decode($value['header'],true)['az'],
                                          'header_en' => \json_decode($value['header'],true)['en'],
                                          'value' => ($value['value']),
                                          'category_az' =>\json_decode($value['category'],true)['az'],
                                          'category_en' => \json_decode($value['category'],true)['en'],
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
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic/?where=(uniq_id,like,".$uniq_id.")");
                     var_dump($get_data);
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic/".$id);
              return response($response->json()); 
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/bf_statistic/$id",[
                     'header' => json_encode(['az'=> $request->input('header_az'),'en' => $request->input('header_en')]) ,
                     'value' => $request->input('value'),
                     'category' => \json_encode(['az'=>$request->input('category_az'),'en' => $request->input('category_en')]) ,
              ]);
              return $response;
       }
       public function updateDataStatus(Request $request, $id)
       {

       }
}