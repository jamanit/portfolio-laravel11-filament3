<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'         => 2,
                'job_title'       => 'Admin',
                'company_name'    => 'PT Pos Indonesia',
                'start_date'      => '2020-05-01',
                'end_date'        => '2020-09-01',
                'job_description' => 'This is a description for Experience',
            ],
            [
                'user_id'         => 2,
                'job_title'       => 'Digitalisasi dan Validasi',
                'company_name'    => 'PT Infomedia Solusi Humanika',
                'start_date'      => '2022-01-01',
                'end_date'        => '2022-02-30',
                'job_description' => 'This is a description for Experience',
            ],
            [
                'user_id'         => 2,
                'job_title'       => 'IT Programmer',
                'company_name'    => 'PT Pulau Sambu Guntung',
                'start_date'      => '2022-03-04',
                'end_date'        => '2024-03-04',
                'job_description' => 'This is a description for Experience',
            ],
            [
                'user_id'         => 2,
                'job_title'       => 'Information Technology',
                'company_name'    => 'KKI Warsi',
                'start_date'      => '2024-04-01',
                'end_date'        => '2024-09-30',
                'job_description' => 'This is a description for Experience',
            ],
            [
                'user_id'         => 2,
                'job_title'       => 'Tenaga Ahli Programmer',
                'company_name'    => 'Diskominfo Sarolangun Jambi',
                'start_date'      => '2025-01-01',
                'end_date'        => null,
                'job_description' => 'This is a description for Experience',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Experience::updateOrCreate(['job_title' => $item['job_title']], $item);
        }
    }
}
