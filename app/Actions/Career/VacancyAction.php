<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use App\Models\VacancyModel;

class VacancyAction extends AdminMethods
{
    private VacancyModel $vacancyModel;
    public function __construct(VacancyModel $vacancyModel)
    {
        $this->vacancyModel= $vacancyModel;
    }

    public function getData()
    {
        try {
            $response = $this->vacancyModel->with('department')->leftJoin('nc_a5um__department','nc_a5um__vacancy.department_id','=','nc_a5um__department.uniq_id')->select('nc_a5um__vacancy.*','nc_a5um__department.title as d_title','nc_a5um__department.slug as d_slug')->orderBy('created_at','desc')->get();
            return response()->json($response,200)->header('Content-type','application/json')->getContent();
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }
    public function postData(Request $request)
    {
        try {
            $response= $this->vacancyModel->create([
                'uniq_id' => Str::random(6),
                'status' => 'active',
                'title' => $request->input('title'),
                'department_id' => $request->input('department_id'),
                'date_duration' => "ssss",
                'description' =>$request->input('description'),
                'description_punkt' =>$request->input('description_punkt'),
                'responsibility' => $request->input('responsibility'),
                'respons_punkt' => $request->input('respons_punkt'),
                'extra_info' => $request->input('extra_info'),
                'slug' => str_replace('"','',$this->slugOlustur($request->input('title'))),
                // 'department_slug' => $this->slugOlustur($request->input('department'))
            ]);
            return response()->json("Created",200);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
    public function deleteData(Request $request)
    {
        try {
            $uniq_id = $request->input('id');
            $response=$this->vacancyModel->where("uniq_id",$uniq_id)->delete();
            return response()->json($response);
        } catch (\Throwable $e){
            throw new \Exception($e);
        }

    }
    public function updateData(Request $request)
    {
        try {
            $uniq_id = $request->input('uniq_id');
            $response = $this->vacancyModel->where("uniq_id",$uniq_id)->update([
                'title' => $request['title'],
                // 'department' => $request->input('department'),
                'date_duration' => $request->input('date_duration'),
                'extra_info' => $request->input('extra_info'),
            ]);
            return response()->json($response);
        }catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
       public function updateDataStatus(Request $request, $id)
       {
           try {
               $this->vacancyModel->where("uniq_id",$id)->update([
                   "status" => $request->input('status')
               ]);
               return response()->json("Updated",200);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = $this->vacancyModel->where("uniq_id",$uniq_id)->get();
               return response()->json($get_data);
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function findDataBySlug($slug)
       {
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(slug,like,"'.$slug.'")');
              return $get_data;
       }
       // public function findDataByDepartment($department)
       // {
       //        $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
       //        ->get('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(department,like,"'.$department.'")');
       //        return $get_data;
       // }
       public function findDataByTitle($title)
       {
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(title,like,"%'.$title.'%")');
              return $get_data;
       }
       // public function search($a)
       // {
       //         $search = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
       //         ->get('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(title,like,%"'.$a.'"%)');
       //         return $search;
       // }
}
