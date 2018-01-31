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

Route::get('/loans', function () {
    return view('pages/loans');
});
Route::get('/apply-loan', function () {
    return view('pages/apply_loan');
});
Route::get('/calculator', function () {
    return view('pages/calculator');
});

Route::post('/submit-loan', ['as' => 'form_url', 'uses' => 'LoansController@add']);

Route::get('/datatables', 'DatatablesController@getIndex');
Route::get('/datatables/members', 'DatatablesController@membersData');
Route::get('/datatables/loans', 'DatatablesController@membersData');
Route::get('/datatables/test', 'DatatablesController@test');
Route::get('/datatables/loans', 'DatatablesController@lendersData');

Route::get('/get_members', 'LoansController@getMembers');
// Route::get('/submit-loan', 'LoansController@add');
// Route::get('datatables', 'DatatablesController', [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);

