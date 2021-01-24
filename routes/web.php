<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@welcome')
    ->name('welcome');

Route::get('/about', function(){
    return view('other/about');
});
Auth::routes(['verify'=>true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/resend', function(Request $request){
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware('auth')->name('verification.resend');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');
//Deze laatste lijn zorgt ervoor dat je geauthenticeerd moet zijn om op de pagina te kunnen

    Route::get('/item', 'ItemController@show');

    Route::middleware('uitleendienst')->group(function () {
        //inventory routes
        Route::post('inventory/search', 'SearchController@search')
            ->name('search.result');

        Route::get('/inventory', 'ItemController@show')
            ->name('inventory');

        Route::get('/inventory/{item}/downloadManual', 'ItemController@downloadPDF')
            ->name('downloadManual');

        Route::get('/inventory/createItem', 'ItemController@showCreate')
            ->name('createItem');

        Route::post('/inventory/createItem', 'ItemController@create')
            ->name('postCreateItem');

        Route::get('/inventory/{item}', 'ItemController@detail')
            ->name('itemDetail');

        Route::get('/inventory/edit/{item}', 'ItemController@showEdit')
            ->name('editItem');
        Route::post('/inventory/edit/{item}', 'ItemController@edit')
            ->name('postEditItem');
        Route::post('/inventory/delete/{item}', 'ItemController@delete')
            ->name('postDeleteItem');

        //loansystem routes
         Route::get('/loan', 'LoanController@index')
                    ->name('loan');


        Route::get('loan/loanItem/{id}', 'LoanController@showLoan')
            ->name('showLoan');
        Route::get('loan/loanOverview', 'LoanController@overview')
            ->name('loanOverview');

        Route::get('/loan/{id}', 'LoanController@show')
            ->name('loanDetail');

        Route::post('/loan/loanItem', 'LoanController@performLoan')
            ->name('performLoan');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin', 'UserController@show')
            ->name('admin');

        Route::get('/admin/edit/{user}', 'UserController@showEdit')
            ->name('editForm');
        Route::post('/admin/edit/{user}', 'UserController@edit')
            ->name('editPost');

        Route::get('/admin/create', 'UserController@showCreate')
            ->name('createUser');

        Route::post('/admin/create', 'UserController@create')
            ->name('postCreateUser');

        Route::get('/admin/delete/{id}', 'UserController@delete')
            ->name('deleteUser');

    });


});
