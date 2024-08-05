<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Utilisateur;
class CompteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Id_util' => 'required|integer|exists:utilisateurs,Id_util',
          
        ]);

        $compte = Compte::create([
            'Id_util' => $request->Id_util,
          
        ]);

        return response()->json($compte, 201);
    }

    
    public function getCompteById($id)
    {
        $compte = Compte::with('transactions')->find($id);
    
        if ($compte) {
            // Calculer le solde basé sur les transactions
            $solde = $compte->transactions->reduce(function ($carry, $transaction) {
                return $transaction->type === 'recette'
                    ? $carry + $transaction->montan
                    : $carry - $transaction->montan;
            }, $compte->solde); // Utiliser le solde initial du compte
    
            return response()->json([
                'solde'                => $solde,
                // 'date_creation_compte' => $compte->date_creation_compte,
            ]);
        } else {
            return response()->json(['message' => 'Compte non trouvé'], 404);
        }
    }
    





    public function Affiche()
    {
        $result = Compte::select(
            'comptes.Id_compte',
            'comptes.created_at',
            'comptes.Id_util',
            'utilisateurs.Nom_util'
        )
        ->join('utilisateurs', 'comptes.Id_util', '=', 'utilisateurs.Id_util')
    
        ->get();

        return response()->json($result); 
    }    
    
    //requete pour la recuperation des donnees
    public function recuperation()
    {
        $compte = Compte::all();
        return response()->json($compte);
    }


    public function declarer($id_compte){
       $compte=Compte::with('transactions')->findOrFail($id_compte);
       return response()->json($compte);
    }

    //   mbola tsy mande
    public function SUPCompte($id){
       $compte=Compte::find($id);
       $compte->delete();
       return response()->json($compte);
}  
}
