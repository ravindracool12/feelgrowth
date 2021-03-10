<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('member', 'MemberController');
Route::resource('adminMember', 'Admin\MemberController');
Route::resource('take', 'TakeController');
Route::resource('give', 'GiveController');
Route::resource('package', 'PackageController');
Route::resource('bonus', 'BonusController');
