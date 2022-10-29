@extends('layouts.default')
@section('content')
    <div class="d-flex flex-column justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Departament</h4>
        </div>
        <form id="departmentForm" >
            @csrf
            <input type="text" name="title" class="form-control w-25">
            <button class="btn btn-primary btn-sm addNewDepartmentBTN w-25 mt-3" type="submit">
                <i class="mr-1" style="position: relative; top: -1px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </i>
                Əlavə et
            </button>
        </form>
    </div>
    <div id="DepartmentTable"></div>
@endsection
