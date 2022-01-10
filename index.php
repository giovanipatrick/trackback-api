<?php
use App\Methods\InitiateEnv as Env;
use App\Routes\Listening as Route;
require 'vendor/autoload.php';
Env::constants();
Route::Initiliaze();
