<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discipline;
use App\Models\User;

class DisciplineSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'jose@gmail.com')->first();

        Discipline::create([
            'user_id' => $user->id,
            'name' => 'Engenharia de Software',
        ]);

        Discipline::create([
            'user_id' => $user->id,
            'name' => 'Redes de Computadores',
        ]);
    }
}
