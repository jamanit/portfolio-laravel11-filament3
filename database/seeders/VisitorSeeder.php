<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 2,
                'ip'      => null,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Visitor::updateOrCreate(['ip' => $item['ip']], $item);
        }
    }
}
