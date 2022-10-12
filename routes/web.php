<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\v1\SOSFormsController;
use App\Http\Controllers\Admin\v1\ApplicationsController;
use App\Http\Controllers\Admin\v1\BranchController;
use App\Http\Controllers\Admin\v1\TeamController;
use App\Http\Controllers\Admin\v1\MemberController;

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


// first-form
Route::post('/get-member-data', [SOSFormsController::class, 'getMemberData'])->name('get.member.data');
Route::get('/first-form', [SOSFormsController::class, 'firstForm'])->name('FirstForm');
Route::post('/first-form/submit', [SOSFormsController::class, 'submitFirstForm'])->name('firstForm.submit');

// second-form
Route::get('/second-form/{application_id?}', [SOSFormsController::class, 'secondForm'])->name('SecondForm');
Route::post('/second-form/submit', [SOSFormsController::class, 'submitSecondForm'])->name('secondForm.submit');

Route::group(['middleware' => 'auth'], function () {

    // application
    Route::get('/application', [ApplicationsController::class, 'index'])->name('application.index');
    Route::post('/change-application-status/{application_id}', [ApplicationsController::class, 'changeApplicationStatus'])->name('change.application.status');

    // branch
    Route::get('/branch/index', [BranchController::class, 'index'])->name('branch.index');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('/branch/update/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::get('/branch/delete/{id}', [BranchController::class, 'delete'])->name('branch.delete');

    // team
    Route::get('/team/index', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
    Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::get('/team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');

    //member
    Route::get('/member/index', [MemberController::class, 'index'])->name('member.index');

});
