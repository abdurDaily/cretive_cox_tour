<?php

use App\Http\Controllers\Backend\AdditionalMember\AdditionalController;
use App\Http\Controllers\Backend\Foods\FoodController;
use App\Http\Controllers\Backend\Home\HomeController;
use App\Http\Controllers\Backend\Login\loginController;
use App\Http\Controllers\Backend\Transaction\TransactionController;
use App\Http\Controllers\Backend\Transport\TransportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

//REGISTER
Route::prefix('login')->name('login.')->group(function(){
    Route::get('/login', [loginController::class, 'loginIndex'])->name('index');
    Route::post('/auth-check', [loginController::class, 'authCheck'])->name('check.auth');
});


//REGISTER
Route::prefix('registrations')->name('registrations.')->group(function(){
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('index');
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('store');
    Route::get('/view-registrations', [RegistrationController::class, 'viewRegistrations'])->name('view')->middleware('auth');
    Route::put('/registrations/{registration}', [RegistrationController::class, 'update'])->name('update');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('destroy');
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('show');
    Route::post('/additional-members', [RegistrationController::class, 'additionalMembers'])->name('additional.members');
});


//BACKEND
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});


//BACKEND TRANSPORT 
Route::prefix('admin')->name('transport.')->group(function(){
    Route::get('/transport', [TransportController::class, 'transportIndex'])->name('transport');
    Route::post('/transport', [TransportController::class, 'transportStore'])->name('store');
    Route::get('/view-transports', [TransportController::class, 'viewTransport'])->name('view');
});



//BACKEND FOODS 
Route::prefix('admin')->name('foods.')->group(function(){
    Route::get('/foods', [FoodController::class, 'foodsIndex'])->name('foods');
    Route::post('/foods', [FoodController::class, 'foodsStore'])->name('store');
    Route::get('/view-foods', [FoodController::class, 'viewfoods'])->name('view');
});


//BACKEND TRANSACTION  
Route::prefix('admin')->name('transaction.')->group(function(){
    Route::get('/transactions', [TransactionController::class, 'transactionIndex'])->name('transactions')->middleware('auth');
    Route::post('/transactions', [TransactionController::class, 'transactionStore'])->name('store');
    Route::get('/view-transactions', [TransactionController::class, 'viewtransaction'])->name('view');
    Route::get('/transactions-pdf', [PDFController::class, 'transactionPDF'])->name('pdf')->middleware('auth');
   
    // INDIVIDUAL COSTING
    Route::get('/individual-cost', [TransactionController::class, 'individualCost'])->name('individual');
    Route::get('/individual-details/{id}', [TransactionController::class, 'individualDetails'])->name('individual.details');
    Route::get('/edit-individual-details/{id}', [TransactionController::class, 'editIndividualDetails'])->name('edit.individual.details');
    Route::put('/update-individual-details/{id}', [TransactionController::class, 'updateIndividualDetails'])->name('update.individual.details');
});


//BACKEND Additiobnalf
Route::prefix('additional')->name('additional.')->group(function(){
    Route::get('/additional-members', [AdditionalController::class, 'additionalIndex'])->name('index');
    Route::post('/additional-members', [AdditionalController::class, 'storeMembers'])->name('store');
    Route::get('/edit-additional-member/{id}', [AdditionalController::class, 'editMember'])->name('edit');
    Route::put('/edit-additional-member/{id}', [AdditionalController::class, 'updateMember'])->name('update');
});