<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsUpdateRequest;
use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Exception;

class DepartmentsController extends Controller
{
    public function index()
    {
        try
        {
            $departments = DepartmentResource::collection(Department::all());

            return response()->json(compact('departments'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function show(Department $department)
    {
        try
        {
            $departmentResource = new DepartmentResource($department);

            return response()->json(['department' => $departmentResource], 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function store(DepartmentsStoreRequest $request)
    {
        try
        {
            $validRequest = $request->validated();

            $department = new Department;
            $department->name = $validRequest['name'];

            $department->save();

            $message = "Department {$department->name} saved";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function update(DepartmentsUpdateRequest $request, Department $department)
    {
        try
        {
            $validRequest = $request->validated();

            $department->name = $validRequest['name'];

            $department->save();

            $message = "Department {$department->name} updated";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }

    public function destroy(Department $department)
    {
        try
        {
            $department->delete();

            $message = "Department {$department->name} deleted";
            return response()->json(compact('message'), 200);
        }
        catch (Exception $x)
        {
            return response()->json(['error' => $x->getMessage()], 400);
        }
    }
}
