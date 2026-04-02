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
            'name' => 'Guru BK',
            'email' => 'guru_bk@smkbabussalam.sch.id',
            'password' => Hash::make('password'),
            'role' => 'guru_bk',
        ]);
    }
}
