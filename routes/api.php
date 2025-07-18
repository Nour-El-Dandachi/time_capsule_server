<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\CapsuleController;
use App\Http\Controllers\User\MediaController;

Route::group(["prefix" => "v0.1"], function(){
    Route::group(["prefix" => "user"], function(){
        Route::get('/capsules/{id?}', [CapsuleController::class, "getAllCapsules"] );
        Route::get('/revealed_capsules/{id?}', [CapsuleController::class, "getRevealedCapsules"] );
        Route::get('/closed_capsules/{id?}', [CapsuleController::class, "getClosedCapsules"] );
        Route::post('/add_update_capsule/{id?}', [CapsuleController::class, "addOrUpdateCapsule"] );

        Route::get('/media/{id?}', [MediaController::class, "getAllMedia"] );
        Route::post('/add_update_media/{id?}', [MediaController::class, "addOrUpdateMedia"] );
    });
});