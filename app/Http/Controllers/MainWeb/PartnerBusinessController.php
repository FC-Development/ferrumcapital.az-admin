<?php

namespace App\Http\Controllers\MainWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\MainWeb\PartnerApplyController;
use App\Http\Controllers\MainWeb\BusinessApplyController;
class Node{
    public $data;
    public $next;
}
class LinkedList{
    public $head;
    public function __construct()
    {
        $this->head = null;
    }
}
class PartnerBusinessController extends Controller
{
    //
    private BusinessApplyController $business;
    private PartnerApplyController $partner;
    public function __construct
    (
        BusinessApplyController $business,
        PartnerApplyController $partner
    )
    {
        $this->business = $business;
        $this->partner = $partner;
    }
    public function returnAll()
    {
        $arr_=[];
        $business_all = $this->business->getAllApply();
        $partner_all = $this->partner->getAllApply();
        $dlist = new \SplDoublyLinkedList();
        foreach ($business_all as $key => $value) {
            # code...
            $dlist->push($value);
        }
        foreach ($partner_all as $key => $value) {
            # code...
            $dlist->push($value);
        }        
        for ($dlist->rewind(); $dlist->valid(); $dlist->next()) {
            array_push($arr_,$dlist->current());
        }
        return response()->json($arr_,200);
    }
    public function returnView()
    {
        return view('dashboard.career.businessApply');
    }
}
