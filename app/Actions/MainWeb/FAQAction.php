<?php
namespace App\Actions\MainWeb;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Faq;
use ErrorException;
use Exception;
use Throwable;

class FAQAction extends AdminMethods
{
       public function getData()
       {
              try {
                     $response = Faq::all();
                       
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'answer_az' => json_decode($value['answer'],true)['az'],
                                   'answer_en' => json_decode($value['answer'],true)['en'],
                                   'create_time' => ($value['created_at']),
                                   'question_az' => \json_decode($value['question'],true)['az'],
                                   'question_en' => \json_decode($value['question'],true)['en'],
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
              try {
                     $response= Faq::create([
                            'uniq_id' => Str::random(6),
                            'answer' => \json_encode(['az'=> $request->input('answer_az'),'en' =>$request->input('answer_en')]),
                            'question' => \json_encode(['az'=>$request->input('question_az'),'en'=>$request->input('question_en')]),
                     ]);
                     return $response;
              } catch(Throwable $e) {
                     throw new ErrorException($e);
              }
             
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              
              $response=Faq::where('uniq_id',$uniq_id)->delete();
              return $response;
       }
        public function findData(Request $request)
       {
              try {
                     $uniq_id = $request->input('uniq_id');
                     $get_data = Faq::where('uniq_id',$uniq_id)->get();
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'answer_az' => json_decode($value['answer'],true)['az'],
                                   'answer_en' => json_decode($value['answer'],true)['en'],
                                   'create_time' => ($value['created_at']),
                                   'question_az' => \json_decode($value['question'],true)['az'],
                                   'question_en' => \json_decode($value['question'],true)['en'],
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              }catch(Throwable $e) {
                     throw new ErrorException($e);
              }
             
              
       }      
        public function updateData(Request $request)
       {
              try {
                     $uniq_id = $request->input('uniq_id');
              
                     $response = Faq::where('uniq_id',$uniq_id)->update([
                            'answer' => \json_encode(['az'=>$request->input('answer_az'),'en'=>$request->input('answer_en')]),
                            'question' => json_encode(['az'=>$request->input('question_az'),'en' => $request->input('question_en')])
                     ]);
                     return response("Updated",200);
              }catch(Throwable $e){
                     throw new Exception($e);
              }
             
       }
        public function updateDataStatus(Request $request,$id)
       {
              try{
                     $tmp_arr_ = array(
                            "response" =>"",
                            "state" => true
                        );
                     $last_res = Faq::where('uniq_id',$uniq_id)->update([
                            "status" => $request->input('status')
                        ]);
                     $tmp_arr_['response'] = $last_res;
                     return response("Updated",200);
              } catch(Throwable $e) {
                     throw new Exception($e);
              }
       }

}