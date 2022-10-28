<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerGalery;
use mysql_xdevapi\Exception;

class CorpGaleryAction extends AdminMethods
{
    private CareerGalery $galery;
    public function __construct(CareerGalery $galery)
    {
        $this->galery = $galery;
    }
       public function getData()
       {
           try {
               $response = $this->galery->all();
               return response()->json($response);
           } catch (\Throwable $e)
           {
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');
               $get_data=$this->galery->where("uniq_id",$uniq_id)->get();
               $img__ =  explode('/',$get_data[0]['image_upload'])[4];
               Storage::disk('s3')->delete("career_gallery/".$img__);
               $response=$this->galery->where("uniq_id",$uniq_id)->delete();
               return response()->json($response);
           } catch (\Throwable $e)
           {
               throw new Exception($e);
           }

       }
       public function postData(Request $request)
       {
           try {
               $response= $this->galery->create([
                   'uniq_id' => Str::random(6),
                   'image_upload' => $this->uploadAvatar($request,'image_upload','','career_gallery')
               ]);
               return response()->json($response);
           } catch (\Throwable $e)
           {
               throw new \Exception($e);
           }

       }
       public function findData(Request $request)
       {}
       public function updateData(Request $request)
       {}
       public function updateDataStatus(Request $request, $id)
       {}
}
