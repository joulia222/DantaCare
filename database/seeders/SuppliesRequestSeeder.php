<?php

namespace Database\Seeders;

use App\Models\SuppliesRequest;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliesRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // ['device' , 'material' , 'equipment' , 'medicine']

        SuppliesRequest::create([
            'type' => 'material',
            'doctor_id' => 1,
            'quantity' => 3,
            'status' => 'pending',
            'medical_supplies_id' => 1,
        ]);

        SuppliesRequest::create([
            'type' => 'device',
            'doctor_id' => 1,
            'quantity' => 1,
            'status' => 'pending',
            'medical_supplies_id' => 2,
            'taken_date' => Carbon::createFromFormat('d-m-Y', '20-10-2001'),

        ]);
    }
}
