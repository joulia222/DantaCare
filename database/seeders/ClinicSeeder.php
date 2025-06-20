<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Clinic::create([
            'name' => 'clinic 1',
            'code' => '09ish',
            'department_id' => '1',
            'created_by' => '1',
        ]);
     
    }
}
