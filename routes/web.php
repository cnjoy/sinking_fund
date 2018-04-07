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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/admin', 'AdminController@index')->name('home');
Route::get('/test', 'testController@index');
Route::get('/profile', 'MembersController@profile');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/profile', 'MembersController@profile')->name('profile');
    // Route::get('/members', function () {
    //     return view('pages/members');
    // });
    
    // loans page
    Route::get('/loans', function () {
        return view('pages/loans');
    });

    Route::get('/calculator', function () {
        return view('pages/calculator');
    });

    Route::get('/dashboard', 'MembersController@dashboard');
    Route::get('/apply-loan', 'LoansController@applyLoan');    
    Route::post('/submit-loan', ['as' => 'form_url', 'uses' => 'LoansController@add']);
    Route::get('/datatables', 'DatatablesController@getIndex');
    Route::get('/datatables/members', 'DatatablesController@membersData');
    Route::get('/datatables/users-data', 'DatatablesController@usersData');
    Route::get('/datatables/test', 'DatatablesController@test');
    Route::get('/datatables/lenders', 'DatatablesController@lendersData');
    Route::get('/datatables/profile-contribution', 'DatatablesController@getProfileContribution');
    
    // get datatable in loan page
    Route::get('/datatables/loans', 'DatatablesController@loansData');
    
    // show loan details in loans page
    Route::get('/single-loan/{any}', 'DatatablesController@getSingleLoan');
     
    // update amount in loans page details
    Route::post('/update-payment', ['uses' => 'LoansController@updatePaymentRow']);
    Route::get('/get_members', 'LoansController@getMembers');
    Route::resource('members', 'MembersController');
    
    // ajax members update payment
    Route::post('/update-member-payment', ['uses' => 'MembersController@updateMemberPayment']);
    
});


Route::get('sendemail', function () {
    
        $data = array(
            'name' => "Learning Laravel",
        );
    
        Mail::send('emails.application', $data, function ($message) {
    
            $message->from('connect.neri.joy@gmail.com', 'Codev SF');
    
            $message->to('cieliton@codev.com')->subject('Loan Application');
    
        });
    
        return "Your email has been sent successfully";
    
    });









