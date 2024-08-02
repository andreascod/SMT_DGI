<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;

class Utilisateur extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_util';

    protected $fillable = [
        'Nom_util', 'email', 'pass', 'role',
    ];

    public function comptes()
    {
        return $this->hasMany(Compte::class, 'Id_util','Id_util');
    }
   
}
