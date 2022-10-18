<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CorpGaleryAction extends AdminMethods
{
       public function getData()
       {
              $response = Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                 ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cl_gallery");
              if(!isset($response['msg']))
              {   
                     return $response;
              }
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cl_gallery/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cl_gallery/".$id);
              $img__ =  explode('/',$get_data[0]['image_upload'])[4];
              Storage::disk('s3')->delete("career_gallery/".$img__);
              return $get_data->json(); 
       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/cl_gallery",[
                     'uniq_id' => Str::random(6),
                     'image_upload' => $this->uploadAvatar($request,'image_upload','','career_gallery')
              ]);
              return $response;
       }
       public function findData(Request $request)
       {}
       public function updateData(Request $request)
       {}
       public function updateDataStatus(Request $request, $id)
       {}
}