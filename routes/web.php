<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SOSFormsController;
use App\Http\Controllers\Admin\v1\ApplicationsController;

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
    return redirect()->route('FirstForm');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/first-form', [SOSFormsController::class, 'firstForm'])->name('FirstForm');
Route::post('/first-form/submit', [SOSFormsController::class, 'submitFirstForm'])->name('firstForm.submit');

Route::get('/second-form/{application_id?}', [SOSFormsController::class, 'secondForm'])->name('SecondForm');
Route::post('/second-form/submit', [SOSFormsController::class, 'submitSecondForm'])->name('secondForm.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/application',[ApplicationsController::class, 'index'])->name('application.index');
    Route::post('/change-application-status/{application_id}',[ApplicationsController::class, 'changeApplicationStatus'])->name('change.application.status');
});