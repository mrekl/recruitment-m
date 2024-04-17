<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::controller(VideoController::class)->group(function () {
    Route::get('/videos/random', 'getRandom');
    Route::get('/videos/starts-from', 'startsFromLetter');
    Route::get('/videos/long-title', 'getLongerThanOneWordTitle');
});
