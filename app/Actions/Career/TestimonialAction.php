<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TestimonialAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials");
                     if(!isset($response['msg']))
                     {   
                            $res_arr=[];
                            foreach((\json_decode($response,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'fullname_az' => json_decode($value['fullname'],true)['az'] ,
                                          'fullname_en' =>json_decode($value['fullname'],true)['en'],
                                          'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                          'text_az' =>\json_decode($value['text'],true)['az'],
                                          'text_en' => \json_decode($value['text'],true)['en'],
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials",[
                     'uniq_id' => Str::random(6),
                     'fullname' => json_encode(['az'=>$request->input('fullname_az'),'en'=>$request->input('fullname_en')]),
                     'text' => json_encode(['az'=>$request->input('text_az'),'en'=>$request->input('text_en')])
              ]);
              return $response;
       }
       public function updateData(Request $request)
       {
       
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/$id",[
                     'fullname' => json_encode(['az'=>$request->input('fullname_az'),'en'=>$request->input('fullname_en')]),
                     'text' => json_encode(['az'=>$request->input('text_az'),'en'=>$request->input('text_en')])
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/'.$response[0]['id'], [
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
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/".$id);
              return response($response->json()); 
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/career_testimonials/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'fullname_az' => json_decode($value['fullname'],true)['az'] ,
                                   'fullname_en' =>json_decode($value['fullname'],true)['en'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'text_az' =>\json_decode($value['text'],true)['az'],
                                   'text_en' => \json_decode($value['text'],true)['en'],
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }
       }
}