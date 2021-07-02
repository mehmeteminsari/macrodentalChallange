<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

// Route::get('/', function () {
//     return view('app');
// });
// Route::inertia('/', 'App');

Route::get('/',[FormController::class,'index'])->name('app');
Route::get('/citylist',[FormController::class,'citylist']);

Route::get('/{id}',[FormController::class,'edit']);

Route::post('/photo/{id}',[FormController::class,'imageUpload']);
Route::post('/{id}',[FormController::class,'update'])->name('updateuser');

Route::get('/{id}/distlist',[FormController::class,'distlist']);









// Route::post('/form/e')
