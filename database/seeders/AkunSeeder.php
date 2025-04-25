<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Member',
                'username' => 'member',
                'password' => Hash::make('123'),
                'role' => 'member',
            ],
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
