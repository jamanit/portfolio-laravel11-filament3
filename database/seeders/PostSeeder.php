<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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
                'title'       => 'Post Title',
                'image'       => null,
                'description' => 'This is a description for Post',
                'labels'      => 'Laravel 11, Filament, GitHub',
                'total_view'  => 100,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Post::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
