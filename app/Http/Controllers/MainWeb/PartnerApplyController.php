<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PartnerApply;
use Exception;
use Illuminate\Support\Facades\DB;

class PartnerApplyController extends Controller
{
    //
    private PartnerApply $partner;
    public function __construct(PartnerApply $partner)
    {
        $this->partner = $partner;
    } 
    public function getApplyByUniqID(Request $request,$uniq_id)
    {
        $apply = DB::select("SELECT * from nc_a5um__partner_application where uniq_id = '$uniq_id'");
        return response($apply);
    }
    public function getAllApply()
    {
        $apply = $this->partner::all();
        return $apply;
    }
}
