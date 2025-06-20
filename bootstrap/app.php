<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\PatientAuthMiddleware;
use App\Http\Middleware\ReceptionAuthMiddleware;
use App\Http\Middleware\StoreKeeperEmployeeAuthMiddleware;
use App\Http\Middleware\DoctorAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                    ->prefix('admin')
                    ->name('admin.')
                    ->group(base_path('routes/Admin.php'));

                Route::middleware('web')
                ->prefix('doctor')
                ->name('doctor.')
                ->group(base_path('routes/Doctor.php'));

            
                Route::middleware('web')
                ->prefix('reception')
                ->name('reception.')
                ->group(base_path('routes/Reception.php'));

                Route::middleware('web')
                ->prefix('storeKeeperEmployee')
                ->name('storeKeeperEmployee.')
                ->group(base_path('routes/StoreKeeperEmployee.php'));

                Route::middleware('web')
                ->prefix('patient')
                ->name('patient.')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'admin.auth' => AdminAuthMiddleware::class,
            'reception.auth' => ReceptionAuthMiddleware::class,
            'storeKeeperEmployee.auth' => StoreKeeperEmployeeAuthMiddleware::class,
            'patient.auth' => PatientAuthMiddleware::class,
            'doctor.auth' => DoctorAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
