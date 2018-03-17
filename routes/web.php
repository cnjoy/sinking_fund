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

Route::get('/calculator', function () {
    return view('pages/calculator');
});

Route::get('/apply-loan', 'LoansController@applyLoan');


Route::post('/submit-loan', ['as' => 'form_url', 'uses' => 'LoansController@add']);

Route::get('/datatables', 'DatatablesController@getIndex');
Route::get('/datatables/members', 'DatatablesController@membersData');
Route::get('/datatables/test', 'DatatablesController@test');
Route::get('/datatables/lenders', 'DatatablesController@lendersData');
Route::get('/datatables/loans', 'DatatablesController@loansData');
Route::get('/single-loan/{any}', 'DatatablesController@getSingleLoan');

Route::get('/get_members', 'LoansController@getMembers');
Route::resource('members', 'MembersController');

Route::post('/update-payment', ['uses' => 'LoansController@updatePaymentRow']);
Route::post('/update-member-payment', ['uses' => 'MembersController@updateMemberPayment']);


// Route::get('member/{member_id}', function (App\Member $member) {
//     return $member->get()->is_dir;
// });
// Route::get('member/{member_id}', 'App\Member');
// Route::get('/submit-loan', 'LoansController@add');
// Route::get('datatables', 'DatatablesController', [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('home');
