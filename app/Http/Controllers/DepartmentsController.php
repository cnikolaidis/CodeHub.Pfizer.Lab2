<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentManagerRequest;
use App\Http\Requests\DepartmentsUpdateRequest;
use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\User;
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

    public function storeManager(Department $department, DepartmentManagerRequest $request)
    {
        try
        {
            $validRequest = $request->validated();

            $userId = $validRequest['id'];
            $user = User::all()->find($userId);
            $department->managerId = $user->id;
            $department->save();

            $message = "Manager {$user->fullName} is now manager of department {$department->name}";
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
