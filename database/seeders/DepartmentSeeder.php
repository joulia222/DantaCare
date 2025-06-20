<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Department::create([
            'name' => 'First Deparment',
            'code' => 'OWC6',
            'created_by' =>'1'
        ]);

        Department::create([
            'name' => 'Third Deparment',
            'code' => 'AS34',
            'created_by' =>'1'
        ]);
    }
}
