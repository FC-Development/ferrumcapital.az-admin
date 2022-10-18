<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessApply;
use Exception;
use Illuminate\Support\Facades\DB;

class BusinessApplyController extends Controller
{
    //
    private BusinessApply $apply;
    public function __construct(BusinessApply $apply)
    {
        $this->apply = $apply;
    }
    public function getBusinessByUniqID(Request $request,$uniq_id)
    {
        $apply = DB::select("SELECT * from nc_a5um__business_application where uniq_id = '$uniq_id'");
        return response($apply);
    }
    public function getAllApply ()
    {
        $apply = $this->apply::all();
        return $apply;
    }
    
}
