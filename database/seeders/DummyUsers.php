<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Alisha Fatha',
                'username' => 'alisha',
                'role' => 'admin',
                'password' => bcrypt('alisha123'),
            ],
            [
                'name' => 'Guru',
                'username' => 'guru',
                'role' => 'guru',
                'password' => bcrypt('guru123'),
            ]
            ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
