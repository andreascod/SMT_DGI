<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
class UtilisateurController extends Controller
{
   public function Util(Request $request){
    $validator = Validator::make($request->all(), [
        'Nom_util'=>'required|string|max:50',
        'email'=>'required|string|max:50',
        'pass'=>'required|confirmed',
        'role'=>'required|string|max:10',
       
       ]);
       if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }
    $user = Utilisateur::create([
      'email' => $request->email,
      'pass' => Hash::make($request->pass),
  ]);
  auth()->attempt($request->only('email','pass'));


  
    // Générer un jeton d'authentification
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);  
   }
     
      // Fonction pour la connexion
    public function logks(Request $request)
    {
        // Valider les données de la requête
        $validator = Utilisateur::make($request->all(), [
            'email' => 'required|email',
            'pass' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Vérifier les informations d'identification
        if (!Auth::attempt($request->only('email', 'pass'))) {
            return response()->json(['error' => 'Informations de connexion invalides'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

/////////////////////////////////////////////////////////////////////////////

   public function modifier(Request $request ,$id){
    $request->validate([
        'Nom_util'=>'required|string|max:50',
        'email'=>'required|string|max:50',
        'pass'=>'required|string|max:8',
        'role'=>'required|string|max:10',
        
       ]);
       $utlisateur=Utilisateur::find($id);
       if(!$utlisateur){
        return response()->json(['message'=>'Utilisateur nom trouver',404]);
       }

       $utlisateur->Nom_util=$request->input('Nom_util');
       $utilisateur->email=$request->input('email');
       $utilisateur->pass=$request->input('pass');
       $utilisateur->role=$request->input('role');
       

       $utilisateur->save();
       return response()->json(['message'=>'utilisateur trouver',200]);
   }
   public function Supprimer($id){
      $utilisateur=Utilisateur::find($id);
      if(!$utilisateur){
        return response()->json(['message'=>'utilisateur non trouver',404]);
      }
      $utilisateur->delete();
      return response()->json(['message'=>'utilisateur supprimer avec succee',200]);
   }

//    recuperation
   public function recuperation()
    {
        $utilisateurs = Utilisateur::all();
        return response()->json($utilisateurs);
    }
    //requete nombre des contribuable
    public function COUNT(){
        $utilisateur=Utilisateur::count();
        dd($utilisateur);
        return response()->json($utilisateur);
    }
}
