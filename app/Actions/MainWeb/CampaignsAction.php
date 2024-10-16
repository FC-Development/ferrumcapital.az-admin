<?php
namespace App\Actions\MainWeb;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Abstracts\AdminMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\Campaigns;
use Mockery\Exception;
use Throwable;

class CampaignsAction extends AdminMethods
{
    private Campaigns $campaigns;

    public function __construct(Campaigns $campaigns)
    {
        $this->campaigns = $campaigns;
    }

    public function getData()
    {
        try {
            $response = $this->campaigns->where('status', '=', 1)->orderBy('id', 'desc')->get();
            return response()->json($response);
        } catch (Throwable $e)  {
            throw new Exception($e);
        }
    }
       public function postData(Request $request)
       {
           try {
               $slug =  $this->slugOlustur($request->input('campaign_title_input'));
               $check_slug = $this->campaigns->where('slug',$slug)->get();
               if(count($check_slug) >0 ) return response()->json("Eyni başlıqda kampaniya mövcuddur!",404);
               $rand_uuid =  Str::random(6);
               $response = $this->campaigns->create([
                   'uniq_id' => $rand_uuid,
                   'status' => 1,
                   'campaign_title' => $request->input('campaign_title_input'),
                   'campaign_image' => $this->uploadAvatar($request,'image_campaign_input','','campaign_images'),
                   'campaign_mobile_image' => $this->uploadAvatar($request,'image_mobile_campaign_input','','campaign_images'),
                   'description' => $request->input('CampaignModalEditor_input'),
                   'slug' => $slug,
                   "end_duration" => $request->input('campaign_lastdate_input'),
                   "partner_id" => $request->input('CampaignPartnerModalEditor_input')
               ]);
               $q = DB::table('nc_1gn9__campaigns')->insert([
                    "uniq_id" => $rand_uuid,
                    "title" => $request->input('campaign_title_input'),
                    "image_preview" => $this->uploadAvatar($request,'image_campaign_input','','campaign_images'),
                    "image_banner" => $this->uploadAvatar($request,'image_mobile_campaign_input','','campaign_images'),
                    "image_mobile_banner" => $this->uploadAvatar($request,'image_mobile_campaign_input','','campaign_images'),
                    "description" => $request->input('CampaignModalEditor_input'),
                    "status" => "true",
                    "slug" => $slug,
                    "mobile" => 1,
                    "partner_id" => $request->input('CampaignPartnerModalEditor_input')

                ]);
               return response()->json($response);
           } catch (Throwable $e) {
               throw new Exception($e);
           }
        }
       public function findData(Request $request)
       {
           try {
               $uniq_id = $request->input("uniq_id");
               $data = $this->campaigns->where("uniq_id",$uniq_id)->get();
               return response()->json($data);
           } catch (Throwable $e) {
               throw new Exception($e);
           }
       }
       public function deleteData(Request $request)
       {
           try {
               $uniq_id = $request->input('id');
               $get_data = $this->campaigns->where('uniq_id',$uniq_id)->get();
               $id = $get_data[0]['id'];
               $image = explode('/',$get_data[0]['campaign_image'])[4];
               Storage::disk('s3')->delete("campaign_images/".$image);
               $mobile_image = explode('/',$get_data[0]['campaign_mobile_image'])[4];
               Storage::disk('s3')->delete("campaign_images/".$mobile_image);
               $response = $this->campaigns->where('uniq_id',$uniq_id)->delete();
               return response()->json($response);
           } catch (Throwable $e) {
               throw new Exception($e);
           }
       }
       public function updateDataStatus(Request $request,$id)
       {
           try {
               $updated_data = $this->campaigns->where("uniq_id",$id)->update([
                   'status' => $request->input("status")
               ]);
               return response()->json($updated_data);
           } catch (Throwable $e) {
               throw new Exception($e);
           }
       }
       public function updateData(Request $request)
       {
           try {
               $uniq_id = $request->input("uniq_id");
               $old_data = $this->campaigns->where("uniq_id",$uniq_id)->get();
               $campaign_image_old = $old_data[0]['campaign_image'];
               $campaign_mobile_image_old = $old_data[0]['campaign_mobile_image'];
               $update_data= $this->campaigns->where("uniq_id",$uniq_id)->update([
                   "campaign_title"=> $request->input("campaign_title"),
                   "campaign_image"=> $this->uploadAvatar($request,'image_mobile_campaign_input',$campaign_image_old,'campaign_image'),
                   "campaign_mobile_image"=> $this->uploadAvatar($request,'image_mobile_campaign_input',$campaign_mobile_image_old,'campaign_mobile_image'),
                   "description"=> $request->input('description'),
                   "slug"=> $request->input("slug"),
                   "end_duration"=> $request->input("end_duration"),
                   "status" => $request->input("status")
               ]);
               return response()->json($update_data);
           } catch (Throwable $e){
               throw new Exception($e);
           }
       }
}
