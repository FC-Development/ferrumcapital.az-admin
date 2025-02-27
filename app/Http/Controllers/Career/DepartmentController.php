<?php

namespace App\Http\Controllers\Career;

use App\Actions\Career\DepartmentAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    private $department;
    public function __construct(DepartmentAction $department)
    {
        $this->department=$department;
    }


    public function departmentPage()
    {
        return view('dashboard.career.department');
    }
    /**
     * @return JsonResponse
     */
    public function getDepartment(): JsonResponse
    {
        return $this->department->getData();
    }

    /**
    * @return JsonResponse
     */
    public function createDepartment(Request $request) : JsonResponse
    {
        $data = $this->department->postData($request);
        return $data;
    }
    /**
     * @return JsonResponse
     */
    public function deleteDepartment(Request $request) : JsonResponse
    {
        $data = $this->department->deleteData($request);
        return $data;
    }
}
