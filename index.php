<?php
use App\Methods\InitiateEnv as Env;
use App\Routes\Listening as Route;
error_reporting(0);
require 'vendor/autoload.php';
Env::constants();
Route::Initiliaze();

