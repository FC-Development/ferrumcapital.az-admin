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
    }

    public function postData(Request $request)
    {
        try {
            $slug = $this->slugOlustur($request->input('slug'));
            $check_slug = $this->department->where("slug",$slug)->get();
            if($check_slug) return response()->json("Eyni başlıqda departament mövcuddur");
            $data = $this->department->create([
                'title' =>$request->input('title'),
                'slug' =>$slug,
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
            if(sizeof($vacancy) == 0) {
                $data = $this->department->where("uniq_id",$uniq_id)->delete();
                return response()->json($data);
            }
            else{
                return response()->json("Departamentə uyğun vakansiya mövcuddur!",404);
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
