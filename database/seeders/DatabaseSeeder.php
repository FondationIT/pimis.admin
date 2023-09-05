<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        \App\Models\Agent::create([
            'id' => 3394,
            'firstname' => 'David',
            'lastname' => 'Tino',
            'matricule' => 'FP-ST000000D',
            'service' => 'IT',
        ]);

        \App\Models\User::factory()->create([
            'id' => 2345,
            'agent' =>3394,
            'name' => 'David Tino',
            'reference' => 'US-ST000000D',
            'email' => 'test@panzi.com',
            'role' => 'Sup',
        ]);
    }
}
