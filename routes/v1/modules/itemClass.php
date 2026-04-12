<?php

use App\Http\Controllers\Api\v1\ItemClassController;
use Illuminate\Support\Facades\Route;

Route::prefic('v1/item-class')->controller(ItemClassController::class)->group(function(){
  Route::get('/', 'getAllItemClass');
  Route::post('/', 'createItemClass');
  Route::put('/{item-class}','updateItemClass');
  Route::delete('/{item-class}', 'deleteItemClass');
});