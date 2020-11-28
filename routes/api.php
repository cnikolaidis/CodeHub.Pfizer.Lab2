<?php

use App\Http\Controllers\DepartmentsUsersController;
use App\Http\Controllers\UsersVacationsController;
use App\Http\Controllers\UsersSkillsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });

Route::apiResource('users', UsersController::class)->except(['create', 'edit']);
Route::apiResource('skills', SkillsController::class)->except(['create', 'edit']);
Route::apiResource('departments', DepartmentsController::class)->except(['create', 'edit']);

Route::apiResource('users.skills', UsersSkillsController::class)->except(['create', 'edit']);
Route::apiResource('users.vacations', UsersVacationsController::class)->except(['create', 'edit']);
Route::apiResource('departments.users', DepartmentsUsersController::class)->only(['index', 'store', 'destroy']);
