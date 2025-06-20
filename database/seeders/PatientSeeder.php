<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Patient::create([
            'name' => 'patient1',
            'email' => 'patient1@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0986532',
            'status'=>1,
            'age'=>30,
            'gender'=>1,
        ]);

        Patient::create([
            'name' => 'patient2',
            'email' => 'patient2@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0266985',
            'status'=>0,
            'age'=>25,
            'gender'=>0,
        ]);
    }
}
