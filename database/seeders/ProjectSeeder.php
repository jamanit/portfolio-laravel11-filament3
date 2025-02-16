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
                'user_id'     => 1,
                'category_id' => 1,
                'title'       => 'Project Title 1',
                'image'       => 'image1.jpg',
                'description' => 'This is a description for Project 1',
                'project_url' => 'https://example.com/project1',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Project::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
