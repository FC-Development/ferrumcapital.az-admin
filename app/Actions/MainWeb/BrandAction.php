<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Brands;
class BrandAction extends AdminMethods
{

       public function getData()
       {
              $response = Brands::with(['city', 'region'])->get();
              return response()->json($response);
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Brands::where("uniq_id",$uniq_id)->get();
              $res_arr=[];
              foreach((\json_decode($get_data,true)) as $key => $value)
              {
                     $tmp__ = [
                            'uniq_id' => $value['uniq_id'],
                            'adress' => $value['adress'],
                            'sector_id' => $value['sector_id'],
                            'ig' => \json_decode($value['links'],true)['ig'],
                            'fb' => \json_decode($value['links'],true)['fb'],
                            'logo' => $value['logo'],
                            'name' => $value['name'],
                            'phone' => $value['phone'],
                            'status' => $value['status'],
                            "website" => $value['website'],
                            "slider_img_status" => $value['slider_img_status'],
                            "slider_img_path" => $value['slider_img_path'],
                            "slider_img_m_path" => $value['slider_img_m_path'],
                            "city_id" => $value['city_id'],
                            "region_id" => $value['region_id']
                     ];
                     array_push($res_arr,$tmp__);
              }
              return $res_arr;

       }
       public function postData(Request $request)
       {
              $response= Brands::create([
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'name' => $request->input('name'),
                     'phone' => $request->input('phone'),
                     'adress' => $request->input('adress'),
                     'sector_id' => $request->input('sector_id'),
                     'city' => $request->input('city'),
                     "website" => $request->input('website'),
                     'logo' =>$this->uploadAvatar($request,'logo','','brand_logo'),
                     'links' => \json_encode(['ig' => $request->input('ig'),'fb' => $request->input('fb')])
              ]);
              return $response;
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');

              $get_data = Brands::where('uniq_id',$uniq_id)->get();

              $updatedLogo = $this->uploadAvatar($request,'logo',$get_data[0]['logo'],'brand_logo');
              $updatedSliderImg = $this->uploadAvatar($request,'BrandSliderImage',$get_data[0]['slider_img_path'],'brand_slider');
              $updatedSliderImgM = $this->uploadAvatar($request,'BrandSliderMImage',$get_data[0]['slider_img_m_path'],'brand_slider');
              //uploadAvatar(Request $request,$img_name,$old_value,$path)
              $response = Brands::where('uniq_id',$uniq_id)->update([
                     'name' => $request['name'],
                     'sector_id' => $request['sector_id'],
                     'phone' => $request['phone'],
                     'adress' => $request['adress'],
                     'links' =>\json_encode(['ig' => $request->input('ig'),'fb' => $request->input('fb')]),
                     'city_id' => $request['cityUpdateModal'],
                     'region_id' => $request['regionUpdateModal'],
                     'logo' => $updatedLogo,
                     "website" => $request['website'],
                     "slider_img_path" => $updatedSliderImg,
                     "slider_img_m_path" => $updatedSliderImgM,
                     "slider_img_status" => $request['DisplayInSlider']
              ]);

              return $response;
       }
       public function updateDataStatus(Request $request, $id)
       {
               $last_res = Brands::where('uniq_id',$id)->update([
                     "status" => $request->input('status')
                 ]);
                 return response()->json("Updated",200);
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data= Brands::where('uniq_id',$uniq_id)->get();
              $logo__ = explode("/",$get_data[0]['logo'])[4];
              Storage::disk('s3')->delete("brand_logo".$logo__);
              $response= Brands::where('uniq_id',$uniq_id)->delete();
              return response()->json($response);
       }
}
