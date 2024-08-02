<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;

    public function definition()
    {
        return [
            'Nom_util' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'pass' => bcrypt('password'), // mot de passe hashé
            'role' => $this->faker->randomElement(['admin', 'user']), // exemple de rôles
        ];
    }
}
