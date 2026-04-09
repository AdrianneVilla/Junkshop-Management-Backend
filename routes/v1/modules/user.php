<?php

use App\Http\Controllers\Api\v1\UserController;

// Always important
use Illuminate\Support\Facades\Route;

Route::prefix('v1/user')->controller(UserController::class)->group(function() {
  Route::get('/', 'getAllUser');
  Route::post('/', 'createUser');
  Route::put('/{user}', 'updateUser');
  Route::delete('/{user}', 'deleteUser');
});