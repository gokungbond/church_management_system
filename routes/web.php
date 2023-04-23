<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function() {


    Route::get('/home', function(){ return view('home'); });
    Route::get('/', function(){ return view('home'); });




    ################# CHURCH #####################



    Route::get('/church', [App\Http\Controllers\ChurchController::class, 'index']);
    Route::get('church/show', [App\Http\Controllers\ChurchController::class, 'show']);
    Route::post('church/store', [App\Http\Controllers\ChurchController::class, 'store']);
    Route::get('church/{church}', [App\Http\Controllers\ChurchController::class, 'edit']);
    Route::get('church/destroy/{church}', [App\Http\Controllers\ChurchController::class, 'destroy']);




    ################# MINISTRY #####################


    
    Route::get('/ministry', [App\Http\Controllers\MinistryController::class, 'index']);
    Route::get('ministry/show', [App\Http\Controllers\MinistryController::class, 'show']);
    Route::post('ministry/store', [App\Http\Controllers\MinistryController::class, 'store']);
    Route::get('ministry/{ministry}', [App\Http\Controllers\MinistryController::class, 'edit']);
    Route::get('ministry/destroy/{ministry}', [App\Http\Controllers\MinistryController::class, 'destroy']);




    
    ################# FAMILY #####################



    Route::get('/family', [App\Http\Controllers\FamilyController::class, 'index']);
    Route::get('family/show', [App\Http\Controllers\FamilyController::class, 'show']);
    Route::post('family/store', [App\Http\Controllers\FamilyController::class, 'store']);
    Route::get('family/{family}', [App\Http\Controllers\FamilyController::class, 'edit']);
    Route::get('family/destroy/{family}', [App\Http\Controllers\FamilyController::class, 'destroy']);




    ################# MEMBER #####################



    Route::get('/member', [App\Http\Controllers\MemberController::class, 'index']);
    Route::get('member/show', [App\Http\Controllers\MemberController::class, 'show']);
    Route::post('member/store', [App\Http\Controllers\MemberController::class, 'store']);
    Route::get('member/{member}', [App\Http\Controllers\MemberController::class, 'edit']);
    Route::get('member/destroy/{member}', [App\Http\Controllers\MemberController::class, 'destroy']);




    
    ################# EVENT #####################

    

    

    Route::get('/event', [App\Http\Controllers\EventController::class, 'index']);
    Route::get('event/show', [App\Http\Controllers\EventController::class, 'show']);
    Route::post('event/store', [App\Http\Controllers\EventController::class, 'store']);
    Route::get('event/{event}', [App\Http\Controllers\EventController::class, 'edit']);
    Route::get('event/destroy/{event}', [App\Http\Controllers\EventController::class, 'destroy']);





});
