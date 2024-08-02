<?php

namespace Database\Factories;

use App\Models\Compte;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utilisateur;

class CompteFactory extends Factory
{
    protected $model = Compte::class;

    public function definition()
    {
        return [
            'Id_util' => Utilisateur::factory(), // Crée un utilisateur si non existant
            'solde' => $this->faker->randomFloat(2, 0, 10000),
            // 'date_creation_compte' => $this->faker->date(),
        ];
    }
}
