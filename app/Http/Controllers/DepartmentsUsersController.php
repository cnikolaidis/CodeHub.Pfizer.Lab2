<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;

class DepartmentsUsersController extends Controller
{
    public function index(Department $department)
    {
        $department->users;

        return response()->json(compact('department'), 200);
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
