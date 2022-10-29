<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerFaq;
use mysql_xdevapi\Exception;

class CareerFaqAction extends AdminMethods
{
    private CareerFaq $careerFaq;
    public function __construct(CareerFaq $careerFaq)
    {
        $this->careerFaq = $careerFaq;
    }

    function postData(Request $request)
    {
        try {
            $response= $this->careerFaq->create([
                'uniq_id' => Str::random(6),
                'answer' => \json_encode(['az'=>$request->input('answer_az'),'en' => $request->input('answer_en')]),
                'question' => json_encode(['az'=>$request->input('question_az'),'en' => $request->input('question_en')]),
            ]);
            return response()->json($response);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    function getData()
    {
        try {
            $response = $this->careerFaq->all();
            $res_arr=[];
            foreach((\json_decode($response,true)) as $key => $value)
            {
                $tmp__ = [
                    'uniq_id' => $value['uniq_id'],
                    'answer_az' => json_decode($value['answer'],true)['az'],
                    'answer_en' =>json_decode($value['answer'],true)['en'],
                    'create_time' => ($value['created_at']),
                    'question_az' => json_decode($value['question'],true)['az'],
                    'question_en' => json_decode($value['question'],true)['en'],
                ];
                array_push($res_arr,$tmp__);
            }
            return response()->json($res_arr);
        } catch (\Throwable $e) {
            throw new Exception($e);
        }


    }

    function findData(Request $request)
    {
        try {
            $uniq_id = $request->input('uniq_id');
            $get_data = $this->careerFaq->where("uniq_id",$uniq_id)->get();
            $res_arr=[];
            foreach((\json_decode($get_data,true)) as $key => $value)
            {
                $tmp__ = [
                    'uniq_id' => $value['uniq_id'],
                    'answer_az' => json_decode($value['answer'],true)['az'],
                    'answer_en' =>json_decode($value['answer'],true)['en'],
                    'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                    'question_az' => json_decode($value['question'],true)['az'],
                    'question_en' => json_decode($value['question'],true)['en'],
                ];
                array_push($res_arr,$tmp__);
            }
            return response()->json($res_arr);
        }
        catch (\Throwable $e) {
            throw new  \Exception($e);
        }


    }
    function deleteData(Request $request)
    {
        try {
            $uniq_id = $request->input('id');
            $response=$this->careerFaq->where("uniq_id",$uniq_id)->delete();
            return response()->json($response);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
    function updateData(Request $request)
    {
        try {
            $uniq_id = $request->input('uniq_id');
            $response = $this->careerFaq->where("uniq_id",$uniq_id)->update([
                'answer' => \json_encode(['az'=>$request->input('answer_az'),'en' => $request->input('answer_en')]),
                'question' => json_encode(['az'=>$request->input('question_az'),'en' => $request->input('question_en')]),
            ]);
            return response()->json($response);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
    public function updateDataStatus(Request $request, $id)
    {

    }

}
