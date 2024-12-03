<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MetasController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\StatusController;

Route::get('/metas', [MetasController::class, 'index']);

Route::post('/metas', [MetasController::class,'store']);

Route::get('/metas/{MetaID}', [MetasController::class,'show']);

Route::put('/metas/{id}',[MetasController::class,'update']);

Route::delete('/metas/{id}', [MetasController::class,'destroy']);


Route::get('/tasks', [TasksController::class, 'index']);

Route::post('/tasks', [TasksController::class,'store']);

Route::get('/tasks/{MetaID}', [TasksController::class,'show']);

Route::put('/tasks/{id}',[TasksController::class,'update']);

Route::delete('/tasks/{id}', [TasksController::class,'destroy']);

Route::get('/status', [StatusController::class, 'index']);