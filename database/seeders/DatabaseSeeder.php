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

        \App\Models\Agent::factory()->create([
            'name' => 'David Tino',
            'reference' => 'US-ST000000D',
            'email' => 'test@panzi.com',
            'role' => 'Sup',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'David Tino',
            'reference' => 'US-ST000000D',
            'email' => 'test@panzi.com',
            'role' => 'Sup',
        ]);
    }
}
