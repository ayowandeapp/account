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

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


//

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('/');
    Route::post('add-account', 'AccountController@create')->name('account.create');
    Route::post('add-customer', 'CustomerController@create')->name('customer.create');
    Route::post('add-category', 'CategoryController@create')->name('category.create');
    Route::post('get-sub-categoryByCategory', 'SubCategoryController@getSubCategory')->name('get.subcat.by.category');
    Route::post('add-subcategory', 'SubCategoryController@create')->name('subcategory.create');
    Route::post('add-payments', 'PaymentController@create')->name('payments.create');
    Route::post('add-receipts', 'ReceiptController@create')->name('receipts.create');
    Route::post('add-jv', 'JournalVoucherController@create')->name('jv.create');
    Route::post('get-payments/receipts/balance', 'HomeController@getPaymentReceiptBalace')->name('get.payment.receipt.balance');
    Route::post('get-account-ledger', 'LedgerController@index')->name('get.account.ledger');
    Route::post('get-category-ledger', 'LedgerController@categoryLedger')->name('get.category.ledger');
    Route::post('get-subcategory-ledger', 'LedgerController@subcategoryLedger')->name('get.subcategory.ledger');

    //delete record routes
    Route::post('/delete-account', 'AccountController@delete');
    Route::post('/delete-customer', 'CustomerController@delete');
    Route::post('/delete-category', 'CategoryController@delete');
    Route::post('/delete-subcategory', 'SubCategoryController@delete');
    Route::post('/delete-payment', 'PaymentController@delete');
    Route::post('/delete-receipt', 'ReceiptController@delete');
    Route::post('/delete-journalvoucher', 'JournalVoucherController@delete');


    //edit record routes
    Route::post('/edit-account', 'AccountController@edit')->name('edit.account');
    Route::post('/edit-customer', 'CustomerController@edit')->name('edit.customer');
    Route::post('/edit-category', 'CategoryController@edit')->name('edit.category');
    Route::post('/edit-receipt', 'ReceiptController@edit')->name('edit.receipt');
    Route::post('/edit-payment', 'PaymentController@edit')->name('edit.payment');
    Route::post('/getAllAccountSelectOption', 'AccountController@getAllAccountSelectOption')->name('get.all.account.get.option');


    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('settings', function () {
        return view('settings');
    })->name('setting.index');

    Route::post('settings', 'HomeController@settings')->name('setting.post');
});
