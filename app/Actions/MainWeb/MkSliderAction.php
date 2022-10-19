<?php

namespace App\Actions\MainWeb;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Abstracts\AdminMethods;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\MkSlider;
class MkSliderAction extends AdminMethods
{
       private $mk_slider;
       public function __construct(MkSlider $mk_slider)
       {
              $this->mk_slider = $mk_slider;
       }
       public function getData()
       {
              $slider= $this->mk_slider->all();
              return response()->json(['data'=>$slider],200);
       }
       public function deleteData(Request $request)
       {
              $uniq_id = $request->input('uniq_id');
              $deleted_data = $this->mk_slider->where('uniq_id',$uniq_id)->delete();
              if($deleted_data) return response()->json(["msg" => "Deleted"],201);
              return response()->json(['msg' => $deleted_data],500);
       }
       public function postData(Request $request)
       {
              $created_data = 
              $this->
              mk_slider->
              create(
                     [
                            'title' => htmlentities($request->input('title')),
                            'description' => htmlentities($request->input('description')),
                            'uniq_id' => Str::random(6)
                     ]);
              if($created_data) return response()->json(["msg" => "Created"],201);
              return response()->json(['msg' => $created_data],500);
       }
       public function updateData(Request $request)
       {
              
       }
       public function findData(Request $request)
       {
              
       }
       public function updateDataStatus(Request $request, $id)
       {
              
       }
}