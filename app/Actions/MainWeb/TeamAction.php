<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;
class TeamAction extends AdminMethods
{
       private Team $team;
       public function __construct(Team $team)
       {
              $this->team = $team;
       }
       public function getData()
       {
              $response = $this->team::all();
              if(!isset($response['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($response,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'fullname_az' => \json_decode($value['fullname'],true)['az'],
                                   'fullname_en' =>  \json_decode($value['fullname'],true)['en'],
                                    'title_az' => json_decode($value['title'],true)['az'],
                                    'title_en' => json_decode($value['title'],true)['en'],
                                   'linkedin' => $value['linkedin'],
                                   'another_link' => $value['another_link'],
                                   'about_text_az' => json_decode($value['about_text'],true)['az'] ,
                                   'about_text_en' =>json_decode($value['about_text'],true)['en'],
                                   'cover_photo' => $value['cover_photo'],
                                   'activity' => $value['activity'],
                                   'another_image' => $value['another_image'],
                                    'another_image_2' => $value['another_image_2']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return ($res_arr);
              }
       }
       public function postData(Request $request)
       {
              $response= Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->post("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team",[
                     'uniq_id' => Str::random(6),
                     'fullname' => json_encode(['az'=>$request['fullname_az'],'en'=>$request['fullname_en']]),
                     'title' => json_encode(['az'=>$request['title_az'],'en'=>$request['title_en']]),
                     'linkedin' => $request['linkedin'],
                     'another_link' => $request['another_link'],
                     'about_text' => json_encode(['az'=>$request['about_text_az'],'en'=>$request['about_text_en']]),
                     'cover_photo' => $this->uploadAvatar($request,'cover_photo','','team'),
                     'another_image' => $this->uploadAvatar($request,'another_image','','team'),
                      'another_image_2' => $this->uploadAvatar($request,'another_image_2','','team'),
                      'activity' => $request['activity']
              ]);
              return $response;
       }
       public function findData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = $this->team::where('uniq_id',$uniq_id)->get();
              if(!isset($get_data['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'fullname_az' => \json_decode($value['fullname'],true)['az'],
                                   'fullname_en' =>  \json_decode($value['fullname'],true)['en'],
                                    'title_az' => $value['title'] != null ? json_decode($value['title'],true)['az'] : "",
                                    'title_en' => $value['title'] != null ? json_decode($value['title'],true)['en'] :"",
                                   'linkedin' => $value['linkedin'],
                                   'activity_az' => $value['activity'] !=null ? json_decode($value['activity'],true)['az'] : '',
                                   'activity_en' => ($value['activity']) !=null ? json_decode($value['activity'],true)['en'] : '',
                                   'another_link' => $value['another_link'],
                                   'about_text_az' => $value['about_text']!=null ? json_decode($value['about_text'],true)['az'] : "",
                                   'about_text_en' =>$value['about_text']!=null ? json_decode($value['about_text'],true)['en'] : "",
                                   'cover_photo' => $value['cover_photo'],
                                   'another_image' => $value['another_image'],
                                'another_image_2' => $value['another_image_2']
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return ($res_arr);
              }
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
                     )
                     ->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team/?where=(uniq_id,like,".$uniq_id.")");
              $id=$get_data[0]['id'];
              $cover__ =explode("/",$get_data[0]['cover_photo'])[4];
              $another_image__ =explode("/",$get_data[0]['another_image'])[4];
              $another_image_2__ =explode("/",$get_data[0]['another_image_2'])[4];
              Storage::disk('s3')->delete($cover__);
              Storage::disk('main')->delete("team/".$another_image__);
              Storage::disk('main')->delete("team/".$another_image_2__);
              $response=Http::withHeaders(
                     ['xc-auth' => env('NOCODB_AUTH')]
              )->delete("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team/".$id);
              return $response->json();
       }
       public function updateData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team/?where=(uniq_id,like,".$uniq_id.")");
              $id = $get_data[0]['id'];
              $updatedCover = $this->uploadAvatar($request,'cover_photo',$get_data[0]['cover_photo'],'team');
              $updatedAddition = $this->uploadAvatar($request,'another_image',$get_data[0]['another_image'],'team');
              $updatedAddition_2 = $this->uploadAvatar($request,'another_image_2',$get_data[0]['another_image_2'],'team');
              $response = Http::withHeaders(
                     ['xc-auth' => env("NOCODB_AUTH")]
              )->put("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team/$id",[
                     'fullname' => json_encode(['az'=>$request['fullname_az'],'en'=>$request['fullname_en']]),
                    'title' => json_encode(['az'=>$request['title_az'],'en'=>$request['title_en']]),
                     'linkedin' => $request['linkedin'],
                     'activity' => json_encode( ['az' => $request['activity_az'] , 'en' => $request['activity_en']]),
                     'another_link' => $request['another_link'],
                     'about_text' => json_encode(['az'=>$request['about_text_az'],'en'=>$request['about_text_en']]),
                     'cover_photo' => $updatedCover,
                     'another_image' => $updatedAddition,
                        'another_image_2' => $updatedAddition_2
              ]);
              return $response;
       }
       public function updateDataStatus(Request $request, $id)
       {

       }
       public function findDataByUniqId($uniq_id)
       {
        $get_data = Http::withHeaders([
                     'xc-auth' => env('NOCODB_AUTH'),
                     'Content-Type' => 'application/json'
                 ])->get("http://172.16.10.132:3574/nc/ferrumcapital_main_a5um/api/v1/team/?where=(uniq_id,like,".$uniq_id.")");
              if(!isset($get_data['msg']))
              {
                     $res_arr=[];
                     foreach((\json_decode($get_data,true)) as $key => $value)
                     {
                            $tmp__ = [
                                   'uniq_id' => $value['uniq_id'],
                                   'fullname_az' => \json_decode($value['fullname'],true)['az'],
                                   'fullname_en' =>  \json_decode($value['fullname'],true)['en'],
                                'title_az' => json_decode($value['title'],true)['az'],
                                'title_en' => json_decode($value['title'],true)['en'],
                                   'linkedin' => $value['linkedin'],
                                   'activity' => $value['activity'],
                                   'another_link' => $value['another_link'],
                                   'about_text_az' => json_decode($value['about_text'],true)['az'] ,
                                   'about_text_en' =>json_decode($value['about_text'],true)['en'],
                                   'cover_photo' => $value['cover_photo'],
                                   'another_image' => $value['another_image'],
                                'another_image_2' => $value['another_image_2'],
                            ];
                            array_push($res_arr,$tmp__);
                     }
                     return ($res_arr);
              }
       }
}
