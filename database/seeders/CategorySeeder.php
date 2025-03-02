<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 2,
                'name'    => 'Category 1',
            ],
            [
                'user_id' => 2,
                'name'    => 'Category 2',
            ],
            [
                'user_id' => 2,
                'name'    => 'Category 3',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Category::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
