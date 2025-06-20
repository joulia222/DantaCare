<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nurse;
use Illuminate\Support\Facades\Hash;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Nurse::create([
            'name' => 'Nurse 1',
            'email' => 'nurse1@gmail.com', 
            'password' => Hash::make('password'),
            'gender' => 1,
            'status' => 1,
            'age' => 25,
            'phone' => '1234567890',
            'img' => 'default.jpg',
            'department_id' => 1,
            'created_by' => 1
        ]);
    }
}
