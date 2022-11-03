<?php
namespace App\Abstracts;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

abstract class AdminMethods
{
    function slugOlustur($string)
    {
        $string = str_replace('ü','u',$string);
        $string = str_replace('Ü','U',$string);

        $string = str_replace('ğ','g',$string);
        $string = str_replace('Ğ','G',$string);

        $string = str_replace('ş','s',$string);
        $string = str_replace('Ş','S',$string);

        $string = str_replace('ç','c',$string);
        $string = str_replace('Ç','C',$string);

        $string = str_replace('ö','o',$string);
        $string = str_replace('Ö','O',$string);

        $string = str_replace('ı','i',$string);
        $string = str_replace('İ','I',$string);

        $string = str_replace('ə','e',$string);
        $string = str_replace('Ə','e',$string);

        $string = str_replace(' ','-',$string);
        $string = str_replace('“','',$string);
        $string = str_replace('”','',$string);
        $string = str_replace('"','',$string);
        $string = str_replace('!','-',$string);
        $string = str_replace('?','-',$string);
        $slug= strtolower($string);
        return $slug;
    }
       protected function getCreatedAtAttribute($date) {
              return Carbon::createFromFormat('Y-m-d H:i:s', $date)->locale('az_AZ')->isoFormat('LLL');
       }
       protected function uploadAvatar(Request $request,$img_name,$old_value,$path)
       {
               if($request->file($img_name))
               {

                     if($old_value!=''){
                            $img__ = explode('/',$old_value)[4];
                            Storage::disk('s3')->delete("/$path/".$img__);
                     }
                     $image = $request->file($img_name);
                     $ext_img = $request->file($img_name)->extension();
                     $name = Str::random(6)."_era.".$ext_img;
                     $saving = Storage::disk('s3')->put("/$path/$name",fopen($image,'r+'),'public');
                     $image_s3_path = "//media.ferrumcapital.az"."/$path/".$name;
                     return $image_s3_path;
               }
               else{
                     return $old_value;
               }
       }
       abstract public function getData();
       abstract public function postData(Request $request);
       abstract public function findData(Request $request);
       abstract public function deleteData(Request $request);
       abstract public function updateData(Request $request);
       abstract public function updateDataStatus(Request $request,$id);

}
