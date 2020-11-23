<?php

use App\Http\Controllers\UsersSkillsController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });

Route::get('users', [UsersController::class, 'index']);
Route::get('users/{id}', [UsersController::class, 'show']);

Route::get('skills', [SkillsController::class, 'index']);

Route::get('users/{id}/skills', [UsersSkillsController::class, 'index']);
