<?php

use App\Http\Controllers\UserController;

// Always important
use Illuminate\Support\Facades\Route;

Route::prefix('v1/user')->controller(UserController::class)->group(function() {
  Route::get('/', 'getAllUser');
  Route::post('/', 'createUser');
  Route::put('/{id}', 'updateUser');
  Route::delete('/{id}', 'deleteUser');
});