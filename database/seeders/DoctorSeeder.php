<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Doctor::create([
            'name' => 'doctor1',
            'email' => 'doctor1@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0986532',
            'status'=>1,
            'age'=>30,
            'gender'=>1,
            'specialization_id'=>3,
            'department_id'=>'1',
            'created_by' =>1
        ]);

        Doctor::create([
            'name' => 'doctor2',
            'email' => 'doctor2@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0912532',
            'status'=>0,
            'age'=>26,
            'gender'=>0,
            'specialization_id'=>2,
            'department_id'=>'1',
            'created_by'=>1

        ]);

        Doctor::create([
            'name' => 'doctor3',
            'email' => 'doctor3@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'325896',
            'status'=>1,
            'age'=>40,
            'gender'=>1,
            'specialization_id'=>3,
            'department_id'=>'2',
            'created_by'=>1

        ]);
    }
}
