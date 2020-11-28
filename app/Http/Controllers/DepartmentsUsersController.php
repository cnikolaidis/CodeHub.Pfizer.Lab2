<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentUsersResource;
use App\Models\Department;
use App\Models\User;

class DepartmentsUsersController extends Controller
{
    public function index(Department $department)
    {
        $departmentUsersResource = new DepartmentUsersResource($department);

        return response()->json(['department', $departmentUsersResource], 200);
    }

    public function store(Department $department, User $user)
    {
        $user->departmentId = $department->id;

        $message = "User {$user->fullName} has been assigned to {$department->name}";
        return response()->json(compact('message'), 200);
    }

    public function destroy(Department $department, User $user)
    {
        $user->departmentId = null;
        $user->save();

        $message = "User {$user->fullName} has been removed from {$department->name}";
        return response()->json(compact('message'), 200);
    }
}
