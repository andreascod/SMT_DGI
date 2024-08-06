<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Compte;

class TransactionController extends Controller
{
  
    public function store(Request $request)
    {
        $request->validate([
            'Id_compte' => 'required|integer|exists:comptes,Id_compte',
            'montan'    => 'required|numeric',
            'type'      => 'required|in:recette,depense',
            
        ]);
        $transaction=Transaction::create([
            'Id_compte' =>$request->Id_compte,
            'montan' =>$request->montan,
            'type'  =>$request->type,
        ]);
        // return response()->json($transaction,201);

         // Optionnel: récupérer et retourner les détails du compte mis à jour /nampidiriko farany
         $compte = Compte::find($request->Id_compte);
         return response()->json([
             'transaction' => $transaction,
             'compte'      => $compte,
         ], 201);
    }
    public function getTransactions()
    {
        // Récupérer les transactions groupées par minute
        // $transactions = Transaction::selectRaw('
        //     DATE_FORMAT(created_at, "%Y-%m-%d %H:%i") as minute,
        //     Utilisateurs.Nom_util as contribuable,
        //     SUM(CASE WHEN type = "recette" THEN montan ELSE 0 END) as recette,
        //     SUM(CASE WHEN type = "depense" THEN montan ELSE 0 END) as depense
        // ')
        // ->join('comptes', 'transactions.Id_compte', '=', 'comptes.Id_compte')
        // ->join('utilisateurs', 'comptes.Id_util', '=', 'utilisateurs.Id_util')
        // ->groupBy('minute','utilisateurs.Nom_util')
        // ->get();

        // return response()->json($transactions);
        $transactions = Transaction::selectRaw('
        DATE_FORMAT(transactions.created_at, "%Y-%m-%d %H:%i") as minute,
        utilisateurs.Nom_util as utilisateur,
        SUM(CASE WHEN transactions.type = "recette" THEN transactions.montan ELSE 0 END) as recette,
        SUM(CASE WHEN transactions.type = "depense" THEN transactions.montan ELSE 0 END) as depense
    ')
    ->join('comptes', 'transactions.Id_compte', '=', 'comptes.Id_compte')
    ->join('utilisateurs', 'comptes.Id_util', '=', 'utilisateurs.Id_util')
    ->groupBy('minute','utilisateurs.Nom_util')
    ->get();

    // Vérifier si des transactions ont été trouvées
    if ($transactions->isEmpty()) {
        return response()->json(['message' => 'Compte non trouvé'], 404);
    }

    return response()->json($transactions);
    }

    // select from* transactions where type=depense 06/08/2024
    public function afficheRec(){
        $transaction=Transaction::where('type','depense',)
        ->get();
        return response()->json($transaction);
    }
  


    // Récupérer les transactions groupées par minute pour un utilisateur spécifique 06/08/2024
    public function getTransaction($id)
{
    // $trans=Transaction::with('transactions')->find($id);
    
    $transactions = Transaction::selectRaw('
        DATE_FORMAT(transactions.created_at, "%Y-%m-%d %H:%i") as minute,
        utilisateurs.Nom_util as utilisateur,
        SUM(CASE WHEN transactions.type = "recette" THEN transactions.montan ELSE 0 END) as recette,
        SUM(CASE WHEN transactions.type = "depense" THEN transactions.montan ELSE 0 END) as depense
    ')
    ->join('comptes', 'transactions.Id_compte', '=', 'comptes.Id_compte')
    ->join('utilisateurs', 'comptes.Id_util', '=', 'utilisateurs.Id_util')
    ->where('utilisateurs.Id_util', $id)
    ->groupBy('minute','utilisateurs.Nom_util')
    ->get();

    // Vérifier si des transactions ont été trouvées
    if ($transactions->isEmpty()) {
        return response()->json(['message' => 'Compte non trouvé'], 404);
    }

    return response()->json($transactions);
}

//recuperation Id transaction 
public function recuperationTransaction(){
    $transaction=Transaction::all();
    return response()->json($transaction);
}

}
