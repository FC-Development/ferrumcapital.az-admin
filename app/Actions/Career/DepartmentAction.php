<?php

namespace App\Actions\Career;

use App\Models\VacancyModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentAction extends \App\Abstracts\AdminMethods
{
    private Department $department;
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getData()
    {
        try {
            $data = $this->department->all();
            return response()->json($data);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
        // TODO: Implement getData() method.
    }

    public function postData(Request $request)
    {
        try {
            $data = $this->department->create([
                'title' =>$request->input('title'),
                'slug' => $request->input('slug'),
                'uniq_id' =>Str::random(6)
            ]);
            return response()->json($data);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
        // TODO: Implement postData() method.
    }

    public function findData(Request $request)
    {
        // TODO: Implement findData() method.
    }

    public function deleteData(Request $request) : JsonResponse
    {
        try {
            $uniq_id = $request->input("uniq_id");
            $vacancy = VacancyModel::where("department_id",$uniq_id)->get();
            return response()->json($vacancy);
            if($this->department->vacancies()) {
                return response()->json($this->department->vacancies(),404);
                $data = $this->department->where("uniq_id",$uniq_id)->delete();
                return response()->json($data);
            }
            else{
                return response()->json($this->department->vacancies(),404);
            }

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
        // TODO: Implement deleteData() method.
    }

    public function updateData(Request $request)
    {
        // TODO: Implement updateData() method.
    }

    public function updateDataStatus(Request $request, $id)
    {
        // TODO: Implement updateDataStatus() method.
    }
}
