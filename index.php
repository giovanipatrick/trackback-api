<?php
use App\Methods\InitiateEnv as Env;
use App\Routes\Listening as Route;
try {
    require 'vendor/autoload.php';
    Env::constants();
    Route::Initiliaze();
} catch (\Throwable $th) {
    echo $th->getMessage();
}

