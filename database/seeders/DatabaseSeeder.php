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

        

        $service = [
            [
                'id' => 100,
                'name' => 'Administration',
                'reference' => 'SRV-ADM0000111A',
                'niveau' => 1,
                'parent' => 0,
            ],
            [
                'id' => 200,
                'name' => 'Programme',
                'reference' => 'SRV-PRG0000222P',
                'niveau' => 1,
                'parent' => 0,
            ],

            /// NIVEAU 2 ADM ///

            [
                'id' => 101,
                'name' => 'Finance',
                'reference' => 'SRV-ADM0000123F',
                'niveau' => 2,
                'parent' => 100,
            ],
            [
                'id' => 102,
                'name' => 'Resources Humaines',
                'reference' => 'SRV-ADM0000321R',
                'niveau' => 2,
                'parent' => 100,
            ],
            [
                'id' => 103,
                'name' => 'Logistique',
                'reference' => 'SRV-ADM0000987FL',
                'niveau' => 2,
                'parent' => 100,
            ],
            [
                'id' => 104,
                'name' => 'IT',
                'reference' => 'SRV-ADM0000518IT',
                'niveau' => 2,
                'parent' => 100,
            ],

            /// NIVEAU 2 PRG ///

            [
                'id' => 201,
                'name' => 'Suivie Evaluation',
                'reference' => 'SRV-PRG0000123F',
                'niveau' => 2,
                'parent' => 200,
            ],
        ];

        foreach ($service as $serv){
            \App\Models\Service::create($serv);
        }
        \App\Models\Agent::create([
            'id' => 3394,
            'firstname' => 'David',
            'lastname' => 'Tino',
            'service' => 100,
            'fonction' => 3,
            'matricule' => 'FP-ST000000D',
        ]);

        \App\Models\User::factory()->create([
            'id' => 2345,
            'agent' =>3394,
            'name' => 'David Tino',
            'reference' => 'US-ST000000D',
            'email' => 'test@panzi.com',
            'role' => 'Sup',
        ]);

        \App\Models\Bailleur::factory()->create([
            'id' => 568,
            'agent' =>3394,
            'name' => 'David Tino',
            'reference' => 'US-ST000000D',
            'email' => 'test@panzi.com',
            'role' => 'Sup',
        ]);

        \App\Models\Projet::factory()->create([
            'id' => 3,
            'signature' =>2345,
            'bailleur' => 568,
            'name' => 'Administation',
            'reference' => 'ADM-FP-ST000000D',
            'dateD' => '2008-01-01',
        ]);
    }
}
