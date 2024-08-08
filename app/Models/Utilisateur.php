<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    // Définir la clé primaire
    protected $primaryKey = 'Id_util';

    // Les attributs qui sont modifiables en masse
    protected $fillable = [
        'Nom_util', 'email', 'password', 'role',
    ];
   
    // Les attributs qui doivent être cachés pour les tableaux
    protected $hidden = [
        'password',
    ];

    // Définir la relation avec le modèle Compte
    public function comptes()
    {
        return $this->hasMany(Compte::class, 'Id_util', 'Id_util');
    }

    // Pour que Laravel utilise la clé primaire en tant que identifiant unique pour les utilisateurs
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    // Pour que Laravel utilise le mot de passe pour l'authentification
    public function getAuthPassword()
    {
        return $this->password;
    }
}
