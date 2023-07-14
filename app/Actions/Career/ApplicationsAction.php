<?php
namespace App\Actions\Career;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerApplication;
use App\Models\VacancyModel;
class ApplicationsAction extends AdminMethods
{
    private CareerApplication $application;
    private VacancyModel $vacancy;
    public function __construct(CareerApplication $application,VacancyModel $vacancy)
    {
        $this->application = $application;
        $this->vacancy = $vacancy;
    }

    public function getData()
    {
        $response= $this->application->orderBy('created_at','desc')->get();
        return $response;
    }

    public function findData($uniq_id)
    {
        $get_data = $this->application::where('uniq_id',$uniq_id)->get();
        if(!isset($get_data['msg']))
        {
            $res_arr=[];
            foreach((\json_decode($get_data,true)) as $key => $value)
            {
                $tmp__ = [
                    'uniq_id' => $value['uniq_id'],
                    "name" => $value['name'],
                    "surname" => $value['surname'],
                    "email" => $value['email'],
                    "birthdate" =>  $value['birthdate'],
                    "phone" => $value['phone'],
                    "city" =>  $value['city'],
                    "adress" => $value['adress'],
                    "education" => json_decode($value['education']),
                    "experience" => json_decode($value['experience']),
                    "skills" => json_decode($value['skills']),
                    "certificates" => json_decode(json_decode($value['certificates'])),
                    "url" => json_decode($value['url']),
                    "cv" =>($value['cv']),
                    "status" => $value['status'],
                    "vacancy_source" => $this->vacancy->where('uniq_id',$value['vacancy_source'])->select("title")->get()
                ];
                array_push($res_arr,$tmp__);
            }
            return $res_arr;
        }
    }

    public function deleteData(Request $request)
    {

    }
    public function updateDataStatus(Request $request, $uniq_id)
    {

        $last_res = $this->application->where("uniq_id",$uniq_id)->update([
            "status" => $request->input('status')
        ]);
        return response()->json("Updated",200);
    }
    public function updateData(Request $request)
    {

    }
    public function postData(Request $request)
    {

    }
}
