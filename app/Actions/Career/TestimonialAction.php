<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerTestimonial;
class TestimonialAction extends AdminMethods
{
    private CareerTestimonial $careerTestimonial;
    public function __construct(CareerTestimonial $careerTestimonial)
    {
        $this->careerTestimonial = $careerTestimonial;
    }

    public function getData()
       {
           try {
               $response = $this->careerTestimonial->all();

               $res_arr=[];
               foreach((\json_decode($response,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'fullname_az' => json_decode($value['fullname'],true)['az'] ,
                       'fullname_en' =>json_decode($value['fullname'],true)['en'],
                       'create_time' => ($value['created_at']),
                       'text_az' =>\json_decode($value['text'],true)['az'],
                       'text_en' => \json_decode($value['text'],true)['en'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return response()->json($res_arr);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function postData(Request $request)
       {
           try {
               $response= $this->careerTestimonial->create([
                   'uniq_id' => Str::random(6),
                   'fullname' => json_encode(['az'=>$request->input('fullname_az'),'en'=>$request->input('fullname_en')]),
                   'text' => json_encode(['az'=>$request->input('text_az'),'en'=>$request->input('text_en')])
               ]);
               return response()->json($response);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function updateData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');

               $response = $this->careerTestimonial->where("uniq_id",$uniq_id)->update([
                   'fullname' => json_encode(['az'=>$request->input('fullname_az'),'en'=>$request->input('fullname_en')]),
                   'text' => json_encode(['az'=>$request->input('text_az'),'en'=>$request->input('text_en')])
               ]);

               return response()->json($response);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function updateDataStatus(Request $request, $id)
       {
           try {
               $last_res = $this->careerTestimonial->where("uniq_id",$id)->update([
                   "status" => $request->input('status')
               ]);
               return response()->json($last_res,200);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');

               $response=$this->careerTestimonial->where("uniq_id",$uniq_id)->delete();
               return response()->json($response);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = $this->careerTestimonial->where("uniq_id",$uniq_id)->get();
               $res_arr=[];
               foreach((\json_decode($get_data,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'fullname_az' => json_decode($value['fullname'],true)['az'] ,
                       'fullname_en' =>json_decode($value['fullname'],true)['en'],
                       'create_time' => ($value['created_at']),
                       'text_az' =>\json_decode($value['text'],true)['az'],
                       'text_en' => \json_decode($value['text'],true)['en'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return response()->json($res_arr);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
}
