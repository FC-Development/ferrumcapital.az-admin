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
use Throwable;

class CampaignsAction extends AdminMethods
{
       public function getData()
       {
              $response = Campaigns::where('status', '=', 1)->get();
              return response()->json($response);

       }
       public function postData(Request $request)
       {
              $response = Campaigns::create([
                     'uniq_id' => Str::random(6),
                     'status' => 1,
                     'campaign_title' => $request->input('campaign_title_input'),
                     'campaign_image' =>$this->uploadAvatar($request,'image_campaign_input','','campaign_images'),
                     'campaign_mobile_image' =>$this->uploadAvatar($request,'image_mobile_campaign_input','','campaign_images'),
                     'description' => $request->input('CampaignModalEditor_input'),
                     'slug' => $this->slugOlustur($request->input('campaign_title_input')),
                     "end_duration" => $request->input('campaign_lastdate_input')
              ]);
              return response()->json($response);
       }
       public function findData(Request $request)
       {
              return null;
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('id');
              $get_data= BlogMain::where('uniq_id',$uniq_id)->get();
              $id=$get_data[0]['id'];
              $cover__ = explode('/',$get_data[0]['cover'])[4];
              Storage::disk('s3')->delete("campaign_images/".$cover__);
              $response= BlogMain::where('uniq_id',$uniq_id)->delete();
              return $response;
       }
       public function updateDataStatus(Request $request,$id)
       {
              return null;
       }
       public function updateData(Request $request)
       {
              return null;
       }
}
