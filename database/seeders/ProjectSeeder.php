<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'     => 2,
                'category_id' => 1,
                'title'       => 'Project Title',
                'image'       => null,
                'description' => 'This is a description for Project',
                'labels'      => 'Laravel 11, Filament, GitHub',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Project::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
