<?php
namespace App\Actions\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\LifeGallery;
use mysql_xdevapi\Exception;

class LifegAction extends AdminMethods
{
    private LifeGallery $lifeGallery;
    public function __construct(LifeGallery $lifeGallery)
    {
        $this->lifeGallery = $lifeGallery;
    }

    public function getData()
       {
           try {
               $response = $this->lifeGallery->all();
               return response()->json($response);
           }catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');
               $get_data=$this->lifeGallery->where("uniq_id",$uniq_id)->get();
               $response=$this->lifeGallery->where("uniq_id",$uniq_id)->delete();
               $img__ = explode('/',$get_data[0]['image_upload'])[4];
               Storage::disk('s3')->delete("life_gallery/".$img__);
               return response()->json($response);
           } catch (\Throwable $e) {
               throw new  Exception($e);
           }

       }
       public function postData(Request $request)
       {
              $response= $this->lifeGallery->create([
                     'uniq_id' => Str::random(6),
                     'image_upload' => $this->uploadAvatar($request,'image_upload','','life_gallery')
              ]);
              return response()->json($response);
       }
       public function findData(Request $request)
       {}
       public function updateData(Request $request)
       {}
       public function updateDataStatus(Request $request, $id)
       {}
}
