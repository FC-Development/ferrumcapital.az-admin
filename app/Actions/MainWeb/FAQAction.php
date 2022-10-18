<?php
namespace App\Actions\MainWeb;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FAQAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq");
                     if(!isset($response['msg']))
                     {   
                            $res_arr=[];
                            foreach((\json_decode($response,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'answer_az' => json_decode($value['answer'],true)['az'],
                                          'answer_en' => json_decode($value['answer'],true)['en'],
                                          'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                          'question_az' => \json_decode($value['question'],true)['az'],
                                          'question_en' => \json_decode($value['question'],true)['en'],
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
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq",[
                     'uniq_id' => Str::random(6),
                     'answer' => \json_encode(['az'=> $request->input('answer_az'),'en' =>$request->input('answer_en')]),
                     'question' => \json_encode(['az'=>$request->input('question_az'),'en'=>$request->input('question_en')]),
              ]);
              return $response;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/".$id);
              return response($response->json()); 
       }
        public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {   
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'answer_az' => json_decode($value['answer'],true)['az'],
                                   'answer_en' => json_decode($value['answer'],true)['en'],
                                   'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                                   'question_az' => \json_decode($value['question'],true)['az'],
                                   'question_en' => \json_decode($value['question'],true)['en'],
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")] 
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/$id",[
                     'answer' => \json_encode(['az'=>$request->input('answer_az'),'en'=>$request->input('answer_en')]),
                     'question' => json_encode(['az'=>$request->input('question_az'),'en' => $request->input('question_en')])
              ]);
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
              ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/?where=(uniq_id,like,".$id.")");
              $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/faq/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
              $tmp_arr_['response'] = $last_res->json();
              return response(200);
       }

}