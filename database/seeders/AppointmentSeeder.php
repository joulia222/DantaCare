<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Appointment::create([
            'clinic_id' => 1,
            'patient_id' => 1,
            'start_time' => Carbon::parse('2023-06-02 14:00:00'),
            'end_time' => Carbon::parse('2023-06-02 15:00:00'),
            'day' => Carbon::parse('2023-06-02'),
            'doctor_id' => 1,
            'status' => 'pending',
        ]);
        Appointment::create([
            'clinic_id' => 1,
            'patient_id' => 1,
            'start_time' => Carbon::parse('2023-06-05 13:00:00'),
            'end_time' => Carbon::parse('2023-06-05 14:00:00'),
            'day' => Carbon::parse('2023-06-05'),
            'doctor_id' => 2,
            'status' => 'pending'
        ]);
    }
}
