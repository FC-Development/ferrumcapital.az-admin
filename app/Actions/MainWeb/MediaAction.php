<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use ErrorException;
use Throwable;

class MediaAction extends AdminMethods
{

       public function getData()
       {
              try {
                     $response = Media::all();
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'title' => $value['title'],
                                   'create_time' => $value['created_at'],
                                   'cover' => "",
                                   'incl_img' => "",
                                   'tips_txt' => $value['tips_text'],
                                   'status' => $value['status'],
                                   'media_lang' => $value['language'],
                                   'meta_description' => $value['meta_description']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return $res_arr;
              } catch(Throwable $e) {
                     return response("Error",404);
              }
       }
       public function postData(Request $request)
       {
              $response= Media::create([
                     'uniq_id' => Str::random(6),
                     'status' => 'active',
                     'media_body' => $request->input('media_body'),
                     'title' => $request->input('title'),
                     'cover' =>"",
                     'include_image' =>"",
                     'tips_text' => $request->input('tips_text'),
                  'slug'=>$this->slugOlustur($request->input('title')),
                  'section' => 'media',
                  'language' => $request->input('media_lang'),
                  'meta_description' => $request->input('meta_description')
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Media::where('uniq_id',$uniq_id)->get();
              return $get_data;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data= Media::where('uniq_id',$uniq_id)->get();
              Storage::disk('main')->delete($get_data[0]['cover']);
              Storage::disk('main')->delete($get_data[0]['include_image']);
              $response=Media::where('uniq_id',$uniq_id)->delete();
              return $response;
       }
       public function updateDataStatus(Request $request,$id)
       {
              try {
                     $tmp_arr_ = array(
                            "response" =>"",
                            "state" => true
                        );
                        $last_res = Media::where("uniq_id",$id)->update([
                            "status" => $request->input('status')
                        ]);
                        $tmp_arr_['response'] = $last_res;
                        return response("updated",200);
              } catch(Throwable $e) {
                     return response("ERrror",404);
              }
             
       }
       public function updateData(Request $request)
       {
              try{
                     $data = $request->validate([
                            'title' => 'min:3',
                            'media_body_edit' => 'min:3',
                            'tips_text' => 'min:3',
                            
                     ]);
                     $uniq_id = $request->input('uniq_id');
                     $response = Media::where('uniq_id',$uniq_id)->update([
                            'title' => $data['title'],
                            'tips_text' => $data['tips_text'],
                            'cover' => "",
                            'media_body' => $data['media_body_edit'],
                            'include_image' => "",
                            "language" => $request->input('media_lang'),
                            'meta_description' => $request->input('meta_description')
                     ]);
                     return $response;
              } catch(Throwable $e) {
                     return response("Error",404);
              }
              
       }
}
