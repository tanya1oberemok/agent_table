<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('reports');
});

Route::get('/reports', [ReportController::class, 'index']);
