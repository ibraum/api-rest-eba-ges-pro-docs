<?php

use Illuminate\Support\Facades\Route;


Route::get('/api-docs', function () {
    return view('swagger');
});
