<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', function () {
    return view('example');
});

Route::post('/test', [ServerController::class, 'Registr']);

Route::post('/auth', [ServerController::class, 'teach']);
