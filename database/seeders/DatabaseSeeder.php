<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Compte;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crée 10 utilisateurs et 5 comptes pour chaque utilisateur
        Utilisateur::factory()
            ->count(3)
            ->has(Compte::factory()->count(1), 'comptes')
            ->create();
            $transactions = Transaction::factory()->count(1)->create();    
    }
}
