<?php

use App\Http\Controllers\Api\v1\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/item')->controller(ItemController::class)->group(function(){
  Route::get('/', 'getAllItems');
  Route::post('/', 'createItem');
  Route::put('/{item}','updateItem');
  Route::delete('/{item}', 'deleteItem');
});