<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use App\Models\SuppliesRequest;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            SpecializationSeeder::class,
            DepartmentSeeder::class,
            DoctorSeeder::class,
            ReceptionistSeeder::class,
            StoreKeeperEmployeeSeeder::class,
            PatientSeeder::class,
            ClinicSeeder::class,
            AppointmentSeeder::class,
            MedicalSuppliesSeeder::class,
            SuppliesRequestSeeder::class,
            NurseSeeder::class,
        ]);
    }
}
