<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\Auth\AuthController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\Appointment\AppointmentController;
use App\Http\Controllers\Doctor\Consultation\ConsultationController;
use App\Http\Controllers\Doctor\SuppliesRequest\SuppliesRequestController;
Use App\Http\Controllers\Doctor\NurseHour\NurseWorkHourController;
Use App\Http\Controllers\Doctor\MedicalRecord\MedicalRecordController;
Use App\Http\Controllers\Doctor\Radiography\RadioGraphyController;
  //=================================== Auth Route =============================

Route::get('/login' , [AuthController::class , 'loginPage'])->name('login.page');

Route::post('/login/check' , [AuthController::class , 'login'])->name('login');

Route::group([ 'middleware' => 'doctor.auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //=================================== Dashboard Route =============================

    Route::get('/index', [DoctorController::class, 'index'])->name('index');


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

    //=================================== Consultation Route =============================

    Route::group(['prefix' => 'consultation', 'as' => 'consultation.', 'controller' => ConsultationController::class], function () { 

        Route::get('/', 'index')->name('index');

        Route::get('/{consultation}/edit', 'edit')->name('edit');

        Route::put('/{consultation}/update', 'update')->name('update');

        Route::delete('/{consultation}/destroy', 'destroy')->name('destroy');

    });

    //=================================== Supplies Request Route =============================

    Route::group(['prefix' => 'supplies-request', 'as' => 'supplies.request.', 'controller' => SuppliesRequestController::class], function () { 

        Route::get('/create', 'create')->name('create');

        Route::get('/{status?}', 'index')->name('index')->defaults('status', 'all');

        Route::post('/', 'store')->name('store');

        Route::get('/{suppliesRequest}/edit', 'edit')->name('edit');

        Route::put('/{suppliesRequest}', 'update')->name('update');

    });

     //=================================== Nurse Work Hour Route =============================

     Route::group(['prefix' => 'nurse-hour', 'as' => 'nurse.hour.', 'controller' => NurseWorkHourController::class], function () { 

        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/', 'store')->name('store');

        Route::get('/{nurseWorkHour}/edit', 'edit')->name('edit');

        Route::put('/{nurseWorkHour}', 'update')->name('update');

        Route::delete('/{nurseWorkHour}', 'destroy')->name('destroy');

    });
    
      //=================================== Medical Record Route =============================

      Route::group(['prefix' => 'medical-record', 'as' => 'medical.record.', 'controller' => MedicalRecordController::class], function () { 

        Route::get('/', 'index')->name('index');

        Route::get('/{medicalRecord}/inspections', 'inspectionIndex')->name('inspections.index');

        Route::get('/{medicalRecord}/inspections/create', 'inspectionCreate')->name('inspections.create');

        Route::post('/{medicalRecord}/inspections', 'inspectionStore')->name('inspections.store');

        Route::get('/{medicalRecord}/inspections/{inspection}/edit', 'inspectionEdit')->name('inspections.edit');

        Route::put('/{medicalRecord}/inspections/{inspection}', 'inspectionUpdate')->name('inspections.update');

        Route::delete('/{medicalRecord}/inspections/{inspection}', 'inspectionDestroy')->name('inspections.destroy');
    });

    //=================================== Radiography Route =============================

    Route::group(['prefix' => 'radiography', 'as' => 'radiography.', 'controller' => RadiographyController::class], function () { 

        Route::get('/', 'index')->name('index');

        Route::get('/{patient}/show', 'show')->name('show');

        Route::get('/create/{patient}', 'create')->name('create');

        Route::post('/', 'store')->name('store');

        Route::delete('/{radiography}', 'destroy')->name('destroy');
        
    });
});