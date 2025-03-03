<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'     => 2,
                'school_name' => 'SMK Negeri 1 Kota Jambi',
                'degree'      => 'SMA (Senior High)',
                'gpa'         => null,
                'start_year'  => '2013',
                'end_year'    => '2016',
                'description' => null,
            ],
            [
                'user_id'     => 2,
                'school_name' => 'Universitas Nurdin Hamzah',
                'degree'      => 'S1 (Bachelor\'s Degree)',
                'gpa'         => null,
                'start_year'  => '2017',
                'end_year'    => '2021',
                'description' => null,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Education::updateOrCreate(['school_name' => $item['school_name']], $item);
        }
    }
}
