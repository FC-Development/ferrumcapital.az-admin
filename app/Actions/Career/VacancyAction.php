<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use App\Models\VacancyModel;

class VacancyAction extends AdminMethods
{ 
       public function getData()
       {
              $response = VacancyModel::with('department')->leftJoin('nc_a5um__department','nc_a5um__vacancy.department_id','=','nc_a5um__department.uniq_id')->select('nc_a5um__vacancy.*','nc_a5um__department.title as d_title','nc_a5um__department.slug as d_slug')->get();
              return response()->json($response,200)->header('Content-type','application/json')->getContent();
       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy",[
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
                    'department_slug' => $this->slugOlustur($request->input('department'))
              ]);
              return $response;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/".$id);
              return response($response->json());
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(uniq_id,like,".$uniq_id.")");
              var_dump($get_data->body());
              $id = $get_data[0]['id'];
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")]
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/$id",[
                     'title' => $request['title'],
                     'department' => $request->input('department'),
                     'date_duration' => $request->input('date_duration'),
                     'extra_info' => $request->input('extra_info'),
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
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(uniq_id,like,".$id.")");
                 $last_res = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->put('http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/'.$response[0]['id'], [
                     "status" => $request->input('status')
                 ]);
                 $tmp_arr_['response'] = $last_res->json();
                 return response(200);
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders(['xc-auth' => env('NOCODB_AUTH')])
              ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/vacancy/?where=(uniq_id,like,".$uniq_id.")");
              return ($get_data);
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
