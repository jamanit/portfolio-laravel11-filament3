<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'            => 'Super Admin',
            'username'        => 'superadmin',
            'email'           => 'superadmin@gmail.com',
            'password'        => bcrypt('password'),
            'profile_picture' => null,
            'bio'             => "Saya adalah IT Programmer berpengalaman dengan fokus pada pengembangan perangkat lunak, khususnya dalam aplikasi web. Saya telah terlibat dalam berbagai proyek, mulai dari pengembangan hingga pemeliharaan dan peningkatan kinerja aplikasi web jangka panjang. Sepanjang karier saya, saya telah berhasil memberikan solusi web responsif dan mengatasi tantangan kompleks seperti sistem keamanan, sistem validasi, API, dan optimisasi UI/UX. Saya juga disiplin dalam kolaborasi tim untuk memastikan bahwa solusi yang dikembangkan memenuhi tujuan bisnis. Selain pengembangan web, saya memiliki keterampilan dalam bidang IT Teknisi yaitu memperbaiki perangkat komputer dan ponsel serta Desain Grafis seperti pembuatan logo, brosur, poster, banner dan undangan. Dengan kombinasi keahlian ini, saya siap mendukung proyek apa pun yang akan dikerjakan.",
            'phone_number'    => null,
            'whatsapp_number' => null,
            'linkedin_url'    => null,
            'github_url'      => null,
            'facebook_url'    => null,
            'instagram_url'   => null,
            'x_url'           => null,
            'youtube_url'     => null,
            'portfolio_view'  => 0,
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name'            => 'Riki David',
            'username'        => 'riki_david',
            'email'           => 'rikidavidtra.2310@gmail.com',
            'password'        => bcrypt('password'),
            'profile_picture' => null,
            'bio'             => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada nisi tellus, non imperdiet nisi tempor at. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.",
            'phone_number'    => '+6289508475453',
            'whatsapp_number' => '+6289508475453',
            'linkedin_url'    => 'https://www.linkedin.com/in/riki-david-a30752237',
            'github_url'      => 'https://github.com/jamanit',
            'facebook_url'    => null,
            'instagram_url'   => 'https://www.instagram.com/riki_david_/',
            'x_url'           => null,
            'youtube_url'     => 'https://www.youtube.com/@jaman_it',
            'portfolio_view'  => 0,
        ]);
        $user->assignRole('user');
    }
}
