<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Specialization::create([
            'name' => 'Endodontics',
            'description' => 'علاج مشاكل أعصاب وجذور الأسنان (مثل علاج العصب)',
            'created_by' =>'1'
        ]);

        Specialization::create([
            'name' => 'Oral and Maxillofacial Surgery',
            'description' => 'جراحة الفم والفكين مثل إزالة ضرس العقل والزرعات السنية',
            'created_by' =>'1'
        ]);

        Specialization::create([
            'name' => 'Cosmetic Dentistry',
            'description' => 'تحسين مظهر الأسنان من خلال التبييض والتجميل',
            'created_by' =>'1'
        ]);
    }
}
