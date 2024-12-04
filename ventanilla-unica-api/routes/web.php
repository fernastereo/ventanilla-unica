<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'api' => 'Ventanilla Unica',
        'Version' => app()->version(),
        'created by' => 'No Company S.A.S.'
    ];
});

require __DIR__.'/auth.php';
