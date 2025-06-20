<?php

namespace Database\Seeders;

use App\Models\MedicalSupplies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSuppliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        MedicalSupplies::create([
            'name' => 'test1',
            'code' => '493w',
            'type' => 'material',
            'description' => 'smkskkmdc',
            'quantity' => '50',
            'created_by' => '1'
        ]);

        MedicalSupplies::create([
            'name' => 'test2',
            'code' => 'df22',
            'type' => 'device',
            'description' => 'dsdkkw',
            'quantity' => '10',
            'created_by' => '1'
        ]);
    }
}
