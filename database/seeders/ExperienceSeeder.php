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
                'job_title'       => 'Programmer',
                'company_name'    => 'PT Pulau Sambu Guntung',
                'start_year'      => '2017',
                'end_year'        => '2021',
                'job_description' => 'This is a description for Experience',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Experience::updateOrCreate(['job_title' => $item['job_title']], $item);
        }
    }
}
