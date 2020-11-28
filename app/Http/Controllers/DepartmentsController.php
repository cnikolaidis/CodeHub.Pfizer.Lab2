<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsUpdateRequest;
use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = DepartmentResource::collection(Department::all());

        return response()->json(compact('departments'), 200);
    }

    public function show(Department $department)
    {
        $departmentResource = new DepartmentResource($department);

        return response()->json(['department' => $departmentResource], 200);
    }

    public function store(DepartmentsStoreRequest $request)
    {
        $validRequest = $request->validated();

        $department = new Department;
        $department->name = $validRequest['name'];

        $department->save();

        $message = "Department {$department->name} saved";
        return response()->json(compact('message'), 200);
    }

    public function update(DepartmentsUpdateRequest $request, Department $department)
    {
        $validRequest = $request->validated();

        $department->name = $validRequest['name'];

        $department->save();

        $message = "Department {$department->name} updated";
        return response()->json(compact('message'), 200);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        $message = "Department {$department->name} deleted";
        return response()->json(compact('message'), 200);
    }
}
