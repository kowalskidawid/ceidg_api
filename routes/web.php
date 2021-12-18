<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(403);
});
