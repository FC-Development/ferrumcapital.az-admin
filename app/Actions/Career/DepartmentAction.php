<?php

namespace App\Actions\Career;

use Illuminate\Http\Request;
use App\Models\Department;
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
        // TODO: Implement postData() method.
    }

    public function findData(Request $request)
    {
        // TODO: Implement findData() method.
    }

    public function deleteData(Request $request)
    {
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
