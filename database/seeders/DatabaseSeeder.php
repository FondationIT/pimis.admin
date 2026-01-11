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
        $this->call(ApiKeySeeder::class);
        

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
            'email' => 'test@panzi.org',
            'role' => 'Sup',
        ]);

        \App\Models\StatutAgent::create([
            'id' => 674,
            'signature' =>2345,
            'agent' => 3394,
            'etatcivil' => 1,
            'reference' => 'AG-ST-ST000000D',
        ]);

        \App\Models\Bailleur::create([
            'id' => 568,
            'signature' =>2345,
            'name' => 'Fondation Panzi',
            'reference' => 'BLL-FP-ST0000001',
            'phone' => '0999999999',
            'email' => 'info@panzi.org',
            'min1' => 1,
            'min2' => 1001,
            'min3' => 10001,
            'max1' => 1000,
            'max2' => 10000,
            'max3' => 1000000000,
        ]);

        \App\Models\Projet::create([
            'id' => 3,
            'signature' =>2345,
            'bailleur' => 568,
            'name' => 'Administation',
            'reference' => 'ADM-FP-ST0000001',
            'dateD' => '2008-01-01',
        ]);

        \App\Models\Rcaisse::create([
            'id' => 1,
            'reference' => 'RC-FP-ST0000001',
            'projet' =>3,
            'solde' => 0,
        ]);


        \App\Models\Taux::create([
            'id' => 1,
            'user' =>2345,
            'taux' => 2500.00,
        ]);


    }
}
