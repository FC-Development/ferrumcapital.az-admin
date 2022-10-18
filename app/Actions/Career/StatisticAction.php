<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;

class StatisticAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic");
                 if(!isset($response['msg']))
                 {   
                        $res_arr=[];
                        foreach((\json_decode($response,true)) as $key => $value)
                        {
                               $tmp__ = [
                                      'uniq_id' => $value['uniq_id'],
                                      'title_az' => \json_decode($value['title'],true)['az'],
                                      'title_en' => \json_decode($value['title'],true)['en'],
                                      'value' => $value['value'],
                                      'description_az' => \json_decode($value['description'],true)['az'],
                                      'description_en' => \json_decode($value['description'],true)['en'],
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic",[
                     'uniq_id' => Str::random(6),
                     'title' => \json_encode(['az'=> $request->input('title_az'),'en' =>$request->input('title_en')]) ,
                     'value' => $request->input('value'),
                     'description' => json_encode(['az'=> $request->input('description_az'),'en' =>$request->input('description_en')]),
              ]);
              return $response;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic/".$id);
              return response($response->json()); 
       }
       public function findData(Request $request)
       {
              
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'title_az' => \json_decode($value['title'],true)['az'],
                                   'title_en' => \json_decode($value['title'],true)['en'],
                                   'value' => $value['value'],
                                   'description_az' => \json_decode($value['description'],true)['az'],
                                   'description_en' => \json_decode($value['description'],true)['en'],
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cr_statistic/$id",[
                     'title' => \json_encode(['az'=> $request->input('title_az'),'en' =>$request->input('title_en')]) ,
                     'value' => $request->input('value'),
                     'description' => json_encode(['az'=> $request->input('description_az'),'en' =>$request->input('description_en')]),
              ]);
              return $response;
       }
       public function updateDataStatus(Request $request, $id)
       {
              
       }

}