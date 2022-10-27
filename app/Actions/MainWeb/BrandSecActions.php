<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\BrandSectors;
use Throwable;

class BrandSecActions extends AdminMethods
{
       public function getData()
       {
              try{
                     $response = BrandSectors::all();
                     $res_arr=[];
                            foreach((\json_decode($response,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'title_az' => \json_decode($value['title'],true)['az'],
                                          'title_en' => \json_decode($value['title'],true)['en'],
                                          'cover' => ($value['cover']),
                                   ];
                                   array_push($res_arr,$tmp__);
                            }
                            return $res_arr;
              } catch(Throwable $e){
                     return response("Error",404);
              }
             
                 
       }
       public function postData(Request $request)
       {
              $response= BrandSectors::create([
                     'uniq_id' => Str::random(9),
                     'title' => \json_encode(['az'=>$request->input('title_az'),'en' =>$request->input('title_en')]),
                     'cover' =>$this->uploadAvatar($request,'cover','','brand_sector'),
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              try {
                     $uniq_id = $request->input('uniq_id');
                     $get_data = BrandSectors::where('uniq_id',$uniq_id)->get();
                     
                     $res_arr=[];
                            foreach((\json_decode($get_data,true)) as $key => $value)
                            {
                                   $tmp__ = [
                                          'uniq_id' => $value['uniq_id'],
                                          'title_az' => \json_decode($value['title'],true)['az'],
                                          'title_en' => \json_decode($value['title'],true)['en'],
                                          'cover' => ($value['cover']),
                                   ];
                                   array_push($res_arr,$tmp__);
                            }
                            return $res_arr;
              } catch(Throwable $e) {
                     return response("error",404);
              }
              
              
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=BrandSectors::where('uniq_id',$uniq_id)->get();
              if($get_data[0]['cover']!="") {
                     $cover__ = explode("/",$get_data[0]['cover'])[4];
                     Storage::disk('s3')->delete('brand_sector/'.$cover__);
              }
              $response=BrandSectors::where('uniq_id',$uniq_id)->delete();
              return $response; 
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = BrandSectors::where('uniq_id',$uniq_id)->get();
              $updatedImage = $this->uploadAvatar($request,'cover',$get_data[0]['cover'],'brand_sector');
              $response = BrandSectors::where("uniq_id",$uniq_id)->update([
                     'title' => \json_encode(['az'=>$request->input('title_az'),'en' =>$request->input('title_en')]),
                     'cover' => $updatedImage
              ]);
       }
       public function updateDataStatus(Request $request, $id)
       {

       }
}