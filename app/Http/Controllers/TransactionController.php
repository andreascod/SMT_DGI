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
        // Récupérer les transactions groupées par mois
        $transactions = Transaction::selectRaw('
        DATE_FORMAT(created_at, "%Y-%m-%d %H:%i") as minute,
            SUM(CASE WHEN type = "recette" THEN montan ELSE 0 END) as recette,
            SUM(CASE WHEN type = "depense" THEN montan ELSE 0 END) as depense
        ')
        ->groupBy('minute')
        ->get();

        return response()->json($transactions);
    }
}
