<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\NurseController;
use App\Http\Controllers\Admin\ReceptionistController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\StoreKeeperEmployeeController;

Route::get('/login' , [AuthController::class , 'loginPage'])->name('login.page');

Route::post('/login/check' , [AuthController::class , 'login'])->name('login');

Route::group([ 'middleware' => 'admin.auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //=================================== Dashboard Route =============================

    Route::get('/index', [AdminController::class, 'index'])->name('index');

    //============================== Specialization Rote =============================

    Route::group(['prefix' => 'specialization', 'as' => 'specialization.', 'controller' => SpecializationController::class], function () { 

        Route::get('/index', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/store','store')->name('store');

        Route::delete('/delete/{id}','delete')->name('delete');

        Route::get('/edit/{id}', 'edit')->name('edit');

        Route::put('/update/{id}', 'update')->name('update');

    });

    //============================= Doctor Rote ============================

    Route::group(['prefix' => 'doctor', 'as' => 'doctor.', 'controller' => DoctorController::class], function () {

        Route::get('/index', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/store','store')->name('store');

        Route::delete('/delete/{id}','delete')->name('delete');

        Route::get('/edit/{id}', 'edit')->name('edit');

        Route::put('/update/{id}', 'update')->name('update');
    });

        //============================= Receptionist Rote ============================

        Route::group(['prefix' => 'receptionist', 'as' => 'receptionist.', 'controller' => ReceptionistController::class], function () {

            Route::get('/index', 'index')->name('index');
    
            Route::get('/create', 'create')->name('create');
    
            Route::post('/store','store')->name('store');
    
            Route::delete('/delete/{id}','delete')->name('delete');
    
            Route::get('/edit/{id}', 'edit')->name('edit');
    
            Route::put('/update/{id}', 'update')->name('update');
        });

               //============================= Department Rote ============================

               Route::group(['prefix' => 'department', 'as' => 'department.', 'controller' => DepartmentController::class], function () {

                Route::get('/index', 'index')->name('index');
        
                Route::get('/create', 'create')->name('create');
        
                Route::post('/store','store')->name('store');
        
                Route::delete('/delete/{id}','delete')->name('delete');
        
                Route::get('/edit/{id}', 'edit')->name('edit');
        
                Route::put('/update/{id}', 'update')->name('update');
            });


           //============================= Clinic Rote ============================

               Route::group(['prefix' => 'clinic', 'as' => 'clinic.', 'controller' => ClinicController::class], function () {

                Route::get('/index', 'index')->name('index');
        
                Route::get('/create', 'create')->name('create');
        
                Route::post('/store','store')->name('store');
        
                Route::delete('/delete/{id}','delete')->name('delete');
        
                Route::get('/edit/{id}', 'edit')->name('edit');
        
                Route::put('/update/{id}', 'update')->name('update');
            });
     

     //============================= Store Keeper Employee Rote ============================

     Route::group(['prefix' => 'storeKeeperEmployee', 'as' => 'storeKeeperEmployee.', 'controller' => StoreKeeperEmployeeController::class], function () {

        Route::get('/index', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/store','store')->name('store');

        Route::delete('/delete/{id}','delete')->name('delete');

        Route::get('/edit/{id}', 'edit')->name('edit');

        Route::put('/update/{id}', 'update')->name('update');
    });     
    
     //================================= Appointment Rote =================================

    Route::group(['prefix' => 'appointment', 'as' => 'appointment.', 'controller' => AppointmentController::class], function () {

        Route::get('/index', 'index')->name('index');
    });  

    //============================= Nusre Rote ============================

       Route::group(['prefix' => 'nurse', 'as' => 'nurse.', 'controller' => NurseController::class], function () {

        Route::get('/index', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/store','store')->name('store');

        Route::delete('/delete/{id}','delete')->name('delete');

        Route::get('/edit/{id}', 'edit')->name('edit');

        Route::put('/update/{id}', 'update')->name('update');
    }); 
});

 