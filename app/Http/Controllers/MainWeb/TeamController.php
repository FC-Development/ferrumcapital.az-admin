<?php

namespace App\Http\Controllers\MainWeb;

use Illuminate\Http\Request;
use App\Actions\MainWeb\TeamAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainWeb\StoreTeamRequest;

class TeamController extends Controller
{
    //
    private $team__;
    public function __construct(TeamAction $team)
    {
        $this->team__ =  $team;
    }

    public function teamPage()
    {
        return view('dashboard.main-web.team');
    }
    public function getTeam()
    {
        return response($this->team__->getData());
    }
    public function postTeam(StoreTeamRequest $request)
    {
        $team = $this->team__->postData($request);
        return response($team);
    }
    public function deleteTeam(Request $request)
    {
        $data = $this->team__->deleteData($request);
        return response($data);
    }
    public function findTeam(Request $request)
    {
        $data = $this->team__->findData($request);
        return response($data);
    }
    public function updateTeamStatus(Request $request,$id)
    {
         $data=$this->team__->updateDataStatus($request,$id);
         return response($data);
    }
    public function updateTeam(StoreTeamRequest $request)
    {
        $data = $this->team__->updateData($request);
        return response("Success",200);
    }
}
