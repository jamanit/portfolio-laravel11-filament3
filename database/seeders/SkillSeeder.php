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
                'skill_name'  => 'Language Programming',
                'skill_level' => 'Expert',
                'caption'     => 'PHP, JavaScript, CSS',
            ],
            [
                'user_id'     => 2,
                'skill_name'  => 'Framework',
                'skill_level' => 'Expert',
                'caption'     => 'Laravel, ExpressJS, ReactJS, NextJS, Codeigniter',
            ],
            [
                'user_id'     => 2,
                'skill_name'  => 'Database Management',
                'skill_level' => 'Expert',
                'caption'     => 'PostgreSQL, MySQL',
            ],
            [
                'user_id'     => 2,
                'skill_name'  => 'Library',
                'skill_level' => 'Expert',
                'caption'     => 'TailwindCSS, Boostrap, Leaflet, JQuery, Yajra Serverside, Intervention Image, Filament',
            ],
            [
                'user_id'     => 2,
                'skill_name'  => 'Tools',
                'skill_level' => 'Expert',
                'caption'     => 'GitHub, Trello, VSCode',
            ],
            [
                'user_id'     => 2,
                'skill_name'  => 'Others',
                'skill_level' => 'Expert',
                'caption'     => 'Memperbaiki komputer dan ponsel, Desain grafis',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Skill::updateOrCreate(['skill_name' => $item['skill_name']], $item);
        }
    }
}
