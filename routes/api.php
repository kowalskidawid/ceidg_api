<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/company/{nip}', [\App\Http\Controllers\Api\CompaniesController::class, 'company']);
