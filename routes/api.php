<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
    Route::get('/employees/search', [EmployeeController::class, 'search']);
    Route::get('/employees/active', [EmployeeController::class, 'getActiveResources']);
    Route::get('/employees/inactive', [EmployeeController::class, 'getInactiveResources']);
    Route::get('/employees/terminated', [EmployeeController::class, 'getTerminatedResources']);

