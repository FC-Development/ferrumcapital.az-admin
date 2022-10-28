<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerTestimonial;
use mysql_xdevapi\Exception;

class TestimonialCstmrAction extends AdminMethods
{
       public function getData()
       {
           try {
               $response = CareerTestimonial::all();

               $res_arr=[];
               foreach((\json_decode($response,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'fullname_az' => \json_decode($value['fullname'],true)['az'],
                       'fullname_en' => \json_decode($value['fullname'],true)['en'],
                       'create_time' => ($value['created_at']),
                       'text_az' =>\json_decode($value['text'],true)['az'],
                       'text_en' => \json_decode($value['text'],true)['en'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return $res_arr;
           }catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function postData(Request $request)
       {
           try {
               $response= CareerTestimonial::create([
                   'uniq_id' => Str::random(6),
                   'fullname' => \json_encode(['az'=>$request->input('fullname_az'),'en' => $request->input('fullname_en')]),
                   'text' => \json_encode(['az' => $request->input('text_az'),'en' =>$request->input('text_en') ])
               ]);
               return $response;
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function updateData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = CareerTestimonial::where("uniq_id",$uniq_id)->get();
               $response = CareerTestimonial::where("uniq_id",$uniq_id)->update([
                   'fullname' => \json_encode(['az'=>$request->input('fullname_az'),'en' => $request->input('fullname_en')]),
                   'text' => \json_encode(['az' => $request->input('text_az'),'en' =>$request->input('text_en') ])
               ]);

               return $response;
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function updateDataStatus(Request $request, $id)
       {
           try {
               $tmp_arr_ = array(
                   "response" =>"",
                   "state" => true
               );
               $last_res = CareerTestimonial::where("uniq_id",$id)->update([
                   "status" => $request->input('status')
               ]);
               $tmp_arr_['response'] = $last_res;
               return response(200);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');

               $response= CareerTestimonial::where("uniq_id",$uniq_id)->delete();
               return response($response);
           } catch (\Throwable $e){
               throw new Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = CareerTestimonial::where("uniq_id",$uniq_id)->get();

               $res_arr=[];
               foreach((\json_decode($get_data,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'fullname_az' => \json_decode($value['fullname'],true)['az'],
                       'fullname_en' => \json_decode($value['fullname'],true)['en'],
                       'create_time' => ($value['created_at']),
                       'text_az' =>\json_decode($value['text'],true)['az'],
                       'text_en' => \json_decode($value['text'],true)['en'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return $res_arr;

           } catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
}
