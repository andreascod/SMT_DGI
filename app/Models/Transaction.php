<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;
class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey   =   'Id_trans';
    protected $fillable =   [
       'Id_compte','montan','type',
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class,'Id_compte');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            $compte = $transaction->compte;

            if ($transaction->type === 'recette') {
                $compte->solde += $transaction->montan;
            } else if ($transaction->type === 'depense') {
                $compte->solde -= $transaction->montan;
            }

            $compte->save();
        });
    }
}
