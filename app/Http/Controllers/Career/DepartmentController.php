<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function departmentPage()
    {
        return view('dashboard.career.department');
    }
}
