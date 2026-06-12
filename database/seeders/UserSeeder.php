<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar usuário para apresentação
        User::firstOrCreate(
            ['email' => 'jose@gmail.com'],
            [
                'name' => 'José Silva',
                'email' => 'jose@gmail.com',
                'password' => Hash::make('senha1234'),
            ]
        );
    }
}

