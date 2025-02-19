<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'     => 2,
                'skill_name'  => 'Skill Name',
                'skill_level' => 'Expert',
                'caption'     => 'This is a caption for Skill',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Skill::updateOrCreate(['skill_name' => $item['skill_name']], $item);
        }
    }
}
