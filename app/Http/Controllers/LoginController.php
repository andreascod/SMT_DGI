<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Valider les données de la requête
        $validator = Utilisateur::make($request->all(), [
            'email' => 'required|email',
            'pass' => 'required',
        ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // Vérifier les informations d'identification
        // if (!Auth::attempt($request->only('email', 'pass'))) {
        //     return response()->json(['error' => 'Informations de connexion invalides'], 401);
        // }
        dd('ok');
        return response()->json($validator);  
        


}
}