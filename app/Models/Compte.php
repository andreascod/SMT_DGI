<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;
   
    protected $primaryKey = 'Id_compte';
    protected $table = 'comptes';

    protected $fillable = [
        'Id_util', 'solde', 'date_creation_compte',
    ];
    
    protected $dates = ['date_creation_compte'];
    
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_util','Id_util');
    }
}
