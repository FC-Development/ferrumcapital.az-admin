<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Testimonials;
class TestimonialKorpAction extends AdminMethods
{
       public function getData()
       {
           try {
               $response = Testimonials::all();

               $res_arr=[];
               foreach((\json_decode($response,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'image' => $value['image'],
                       'create_time' => ($value['created_at']),
                       'fullname_az' => json_decode($value['fullname'],true)['az'],
                       'fullname_en' => \json_decode($value['fullname'],true)['en'],
                       'youtube_url' => $value['youtube_url'],
                       'company_logo' => $value['company_logo'],
                       'quote_az' => json_decode($value['quote'],true)['az'],
                       'quote_en' => json_decode($value['quote'],true)['en'],
                       'title_en' => json_decode($value['title'],true)['en'],
                       'title_az' => json_decode($value['title'],true)['az'],
                       'status' => $value['status'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return $res_arr;
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
       public function postData(Request $request)
       {
           try {
               $response= Testimonials::create([
                   'uniq_id' => Str::random(6),
                   'status' => 'active',
                   'youtube_url'=> $request->input('youtube_url'),
                   'fullname' =>\json_encode(['az' => $request->input('fullname_az'),'en' => $request->input('fullname_en')]),
                   'quote' => \json_encode(['az'=>$request->input('quote_az'),'en' =>$request->input('quote_en')]),
                   'title' => \json_encode(['az' => $request->input('title_az'),'en' => $request->input('title_en')]) ,
                   'image' =>$this->uploadAvatar($request,'image','','testimonial_korp'),
                   'company_logo' =>$this->uploadAvatar($request,'company_logo','','testimonial_korp'),
               ]);
               return $response;
           }catch (\Throwable $e) {
               throw new \Exception($e);
           }

       }
       public function updateData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = Testimonials::where('uniq_id',$uniq_id)->get();
               $id = $get_data[0]['id'];
               $updatedImage = $this->uploadAvatar($request,'image',$get_data[0]['image'],'testimonial_korp');
               $updatedCompLogo = $this->uploadAvatar($request,'company_logo',$get_data[0]['company_logo'],'testimonial_korp');
               $response = Testimonials::where("uniq_id",$uniq_id)->update([
                   'fullname' => json_encode(['az' => $request->input('fullname_az'),'en' => $request->input('fullname_en')]),
                   'quote' => \json_encode(['az'=>$request->input('quote_az'),'en' =>$request->input('quote_en')]),
                   'title' => \json_encode(['az' => $request->input('title_az'),'en' => $request->input('title_en')]),
                   'image' => $updatedImage,
                   'company_logo' => $updatedCompLogo
               ]);
               return $response;
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function updateDataStatus(Request $request, $id)
       {
           try {
               $tmp_arr_ = array(
                   "response" =>"",
                   "state" => true
               );
               $last_res = Testimonials::where("uniq_id",$id)->update([
                   "status" => $request->input('status')
               ]);
               $tmp_arr_['response'] = $last_res;
               return response(200);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');
               $get_data=Testimonials::where("uniq_id",$uniq_id)->get();
               $id=$get_data[0]['id'];
               $img__ = explode('/',$get_data[0]['image'])[4];
               $company__ = explode('/',$get_data[0]['company_logo'])[4];
               Storage::disk('s3')->delete("testimonial_korp/".$img__);
               Storage::disk('s3')->delete("testimonial_korp/".$company__);
               $response=Testimonials::where('uniq_id',$uniq_id)->delete();
               return response()->json(["msg" => "deleted"],201);
           } catch (\Throwable $e){
               throw new \Exception($e);
           }

       }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input('uniq_id');
               $get_data = Testimonials::where('uniq_id',$uniq_id)->get();

               $res_arr=[];
               foreach((\json_decode($get_data,true)) as $key => $value)
               {
                   $tmp__ = [
                       'uniq_id' => $value['uniq_id'],
                       'image' => $value['image'],
                       'create_time' => $this->getCreatedAtAttribute($value['created_at']),
                       'fullname_az' => json_decode($value['fullname'],true)['az'],
                       'fullname_en' => \json_decode($value['fullname'],true)['en'],
                       'youtube_url' => $value['youtube_url'],
                       'company_logo' => $value['company_logo'],
                       'quote_az' => json_decode($value['quote'],true)['az'],
                       'quote_en' => json_decode($value['quote'],true)['en'],
                       'title_en' => json_decode($value['title'],true)['en'],
                       'title_az' => json_decode($value['title'],true)['az'],
                       'status' => $value['status'],
                   ];
                   array_push($res_arr,$tmp__);
               }
               return $res_arr;
           } catch (\Throwable $e) {
               throw new \Exception($e);
           }


       }
}
