<?php

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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('pages/dashboard');
});

Route::get('/members', function () {
    return view('pages/members');
});

Route::get('/datatables', 'DatatablesController@getIndex');
Route::get('/datatables/members', 'DatatablesController@membersData');
Route::get('/datatables/test', 'DatatablesController@test');


// Route::get('datatables', 'DatatablesController', [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);
