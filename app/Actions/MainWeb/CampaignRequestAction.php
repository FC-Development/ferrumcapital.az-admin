<?php

namespace App\Actions\MainWeb;

use Illuminate\Http\Request;
use App\Models\CampaignRequest;
use Mockery\Exception;

class CampaignRequestAction extends \App\Abstracts\AdminMethods
{
    private CampaignRequest $campaignRequest;
    public function __construct(CampaignRequest $campaignRequest)
    {
        $this->campaignRequest=$campaignRequest;
    }

    public function getData()
    {
        try {
            $data = $this->campaignRequest->all();
            return response()->json($data);
        } catch (\Throwable $e) {
            throw new Exception($e);
        }
        // TODO: Implement getData() method.
    }

    public function postData(Request $request)
    {
        // TODO: Implement postData() method.
    }

    public function findData(Request $request)
    {
        // TODO: Implement findData() method.
    }

    public function deleteData(Request $request)
    {
        // TODO: Implement deleteData() method.
        try {
            $uniq_id=$request->input("uniq_id");
            $deleted_data= $this->campaignRequest->where("uniq_id",$uniq_id)->delete();
            return response()->json($deleted_data);
        } catch (\Throwable $e) {
            throw new Exception($e);
        }

    }

    public function updateData(Request $request)
    {
        // TODO: Implement updateData() method.
    }

    public function updateDataStatus(Request $request, $id)
    {
        try {
            $data = $this->campaignRequest->where("uniq_id",$id)->update([
                'status' => $request->input('status')
            ]);
            return response()->json($data);
        } catch (\Throwable $e) {
            throw new Exception($e);
        }

        // TODO: Implement updateDataStatus() method.
    }
}
