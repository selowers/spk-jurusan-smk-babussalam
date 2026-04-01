<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin SMK',
            'email' => 'admin@smkbabussalam.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Guru BK',
            'email' => 'guru@smkbabussalam.sch.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);
    }
}
