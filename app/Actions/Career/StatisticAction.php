<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use App\Models\CareerStatistics;
class StatisticAction extends AdminMethods
{
    private CareerStatistics $careerStatistics;
    public function __construct(CareerStatistics $careerStatistics)
    {
        $this->careerStatistics = $careerStatistics;
    }
       public function getData()
       {
           try {
               $response = $this->careerStatistics->all();

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
               return response()->json($res_arr,200);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }
       }
       public function postData(Request $request)
       {
              $response= $this->careerStatistics->create([
                     'uniq_id' => Str::random(6),
                     'title' => \json_encode(['az'=> $request->input('title_az'),'en' =>$request->input('title_en')]) ,
                     'value' => $request->input('value'),
                     'description' => json_encode(['az'=> $request->input('description_az'),'en' =>$request->input('description_en')]),
              ]);
              return response()->json($response);
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');

              $response= $this->careerStatistics->where("uniq_id",$uniq_id)->delete();
              return response()->json($response,200);
       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = $this->careerStatistics->where("uniq_id",$uniq_id)->get();
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
               return response()->json($res_arr);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $response = $this->careerStatistics->where("uniq_id",$uniq_id)->update([
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
