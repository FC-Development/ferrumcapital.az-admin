<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\PfStatistic;
use mysql_xdevapi\Exception;

class PfStatisticAction extends AdminMethods
{
       public function getData()
       {
           try {
               $response = PfStatistic::all();
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
               return response()->json($res_arr,200);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function postData(Request $request)
       {
           try {
               $response= PfStatistic::create([
                   'uniq_id' => Str::random(6),
                   'header' => json_encode(['az'=> $request->input('header_az'),'en' => $request->input('header_en')]) ,
                   'value' => $request->input('value'),
                   'category' => \json_encode(['az'=>$request->input('category_az'),'en' => $request->input('category_en')]) ,
               ]);
               return response()->json($response);
           }catch (\Throwable $e) {
               throw new Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data =PfStatistic::where("uniq_id",$uniq_id)->get();

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
               return response()->json($res_arr);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');

              $response= PfStatistic::where("uniq_id",$uniq_id)->delete();
              return response()->json($response);
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');

              $response = PfStatistic::where("uniq_id",$uniq_id)->update([
                     'header' => json_encode(['az'=> $request->input('header_az'),'en' => $request->input('header_en')]) ,
                     'value' => $request->input('value'),
                     'category' => \json_encode(['az'=>$request->input('category_az'),'en' => $request->input('category_en')]) ,
              ]);
              return response()->json($response);
       }
       public function updateDataStatus(Request $request, $id)
       {

       }
}
