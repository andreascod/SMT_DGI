<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;

class CompteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Id_util' => 'required|integer|exists:utilisateurs,Id_util',
            'solde' => 'required|numeric',
            'date_creation_compte' => 'required|date',
        ]);

        $compte = Compte::create([
            'Id_util' => $request->Id_util,
            'solde' => $request->solde,
            'date_creation_compte' => $request->date_creation_compte,
        ]);

        return response()->json($compte, 201);
    }

    public function getCompteById($id)
    {
        // Récupérer un compte spécifique par Id_compte
        $compte = Compte::find($id);

        if ($compte) {
            return response()->json([
                'solde' => $compte->solde,
                // 'date_creation_compte' => $compte->date_creation_compte->format('Y-m-d'),
                
            ]);
        } else {
            return response()->json(['message' => 'Compte non trouvé'], 404);
        }
    }

    public function recuperation()
    {
        $compte = Compte::all();
        return response()->json($compte);
    }
}
