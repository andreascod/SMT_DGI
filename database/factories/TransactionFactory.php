<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Compte;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model=Transaction::class;
    public function definition(): array
    {
        return [
            'Id_compte'=>Compte::factory(),
            'montan'=>$this->faker->randomFloat(2,0,10000),
            'type'=>$this->faker->randomElement(['recette','depense']),
        ];
    }
}
