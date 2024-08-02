<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
class Compte extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_compte';

    protected $fillable = [
        'Id_util', 'solde',
    ];
    protected $attributes   =[
        'solde'=>0.000,
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'Id_util');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'Id_compte');
    }
}
