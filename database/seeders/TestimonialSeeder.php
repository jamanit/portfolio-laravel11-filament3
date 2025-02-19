<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'          => 2,
                'client_name'      => 'Davidtra',
                'testimonial_text' => 'This is a description for Testimonial',
                'client_image'     => null,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Testimonial::updateOrCreate(['client_name' => $item['client_name']], $item);
        }
    }
}
