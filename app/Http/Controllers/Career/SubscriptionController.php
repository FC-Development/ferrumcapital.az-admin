<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionModel;
class SubscriptionController extends Controller
{
    //
    private SubscriptionModel $subscriber;
    public function __construct(SubscriptionModel $subscriber)
    {
        $this->subscriber =  $subscriber;
    } 
    public function getSubsPage()
    {
        return view('dashboard.career.subscription');
    }
    public function getSubscribers()
    {
        $subscriber = $this->subscriber::all();
        return response($subscriber,200);
    }
}
