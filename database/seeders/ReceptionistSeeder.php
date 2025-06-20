<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Receptionist::create([
            'name' => 'receptionist1',
            'email' => 'receptionist1@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0998877',
            'status'=>0,
            'age'=>30,
            'gender'=>1,
            'created_by'=>1

        ]);

        Receptionist::create([
            'name' => 'receptionist2',
            'email' => 'receptionist2@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0998877',
            'status'=>1,
            'age'=>30,
            'gender'=>0,
            'created_by'=>1

        ]);
        Receptionist::create([
            'name' => 'receptionist3',
            'email' => 'receptionist3@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0998877',
            'status'=>0,
            'age'=>30,
            'gender'=>1,
            'created_by'=>1

        ]);
    }
}
