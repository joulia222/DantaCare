<?php

use App\Http\Controllers\Reception\Appointment\AppointmentController;
use App\Http\Controllers\Reception\Auth\AuthController;
use App\Http\Controllers\Reception\ReceptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reception\Service\ServiceController;
use App\Http\Controllers\Reception\MedicalRecord\MedicalRecordController;


  //=================================== Auth Route =============================

Route::get('/login' , [AuthController::class , 'loginPage'])->name('login.page');

Route::post('/login/check' , [AuthController::class , 'login'])->name('login');

Route::group([ 'middleware' => 'reception.auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //=================================== Dashboard Route =============================

    Route::get('/index', [ReceptionController::class, 'index'])->name('index');


       //=================================== Appointment Route =============================

       Route::group(['prefix' => 'appointments', 'as' => 'appointments.', 'controller' => AppointmentController::class], function () { 

           Route::get('/create',  'create')->name('create');

           Route::get('/{status?}', 'index')->name('index')->defaults('status', 'all');

           Route::post('/store','store')->name('store');

           Route::get('/{appointment}/edit', 'edit')->name('edit');

           Route::put('/{appointment}', 'update')->name('update');

           Route::put('/{appointment}/cancel', 'cancel')->name('cancel');

           Route::put('/{appointment}/complete', 'complete')->name('complete');

    });

        //=================================== Service Route =============================

        Route::group(['prefix' => 'service', 'as' => 'service.', 'controller' => ServiceController::class], function () { 

            Route::get('/index', 'index')->name('index');
    
            Route::get('/create', 'create')->name('create');
    
            Route::post('/store','store')->name('store');
    
            Route::delete('/delete/{id}','delete')->name('delete');
    
            Route::get('/edit/{id}', 'edit')->name('edit');
    
            Route::put('/update/{id}', 'update')->name('update');
    
        });

         //=================================== Medical Record Route =============================

         Route::group(['prefix' => 'medical-record', 'as' => 'medical-record.', 'controller' => MedicalRecordController::class], function () { 

            Route::get('/', 'index')->name('index');
    
            Route::get('/create', 'create')->name('create');
    
            Route::post('/', 'store')->name('store');
    
            Route::get('/{medicalRecord}/edit', 'edit')->name('edit');
    
            Route::put('/{medicalRecord}', 'update')->name('update');
    
            Route::delete('/{medicalRecord}', 'destroy')->name('destroy');
    
        });

});