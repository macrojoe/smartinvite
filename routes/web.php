<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\Frontend\GuestController;

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
    return redirect('/admin');
});

Route::get('/i/{event}/{guest}/{code}', [GuestController::class,'show']);

Route::get('/storage', [TestingController::class, 'storageLink']);
Route::get('/migrate', [TestingController::class, 'migrate']);
Route::get('/optimize', [TestingController::class, 'optimize']);

