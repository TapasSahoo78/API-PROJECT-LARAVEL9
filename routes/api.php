<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


Route::group(['middleware' => 'api'], function ($routes) {

    Route::post('register', [UserController::class, 'register']);
});
