<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PanelController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/panel'], function () {
    Route::get('/home', [PanelController::class, 'index']);
    Route::get('/login', [PanelController::class, 'login']);
    Route::post('/login', [PanelController::class, 'post_login']);
    Route::get('/register', [PanelController::class, 'register']);
    Route::post('/register', [PanelController::class, 'post_register']);
    Route::post('/logout', [PanelController::class, 'logout']);
});
