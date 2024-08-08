<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Requests;
 use App\Http\Requests\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth; // Importer Auth
use Illuminate\Support\Facades\Hash; // Importer Hash
class UtilisateurController extends Controller
{
   public function Util(Request $request){
//     $validator = Validator::make($request->all(), [
//         'Nom_util'=>'required|string|max:50',
//         'email'=>'required|string|max:50',
//         'pass'=>'required|confirmed',
//         'role'=>'required|string|max:10',
       
//        ]);
//        if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()], 400);
//     }
//     $user = Utilisateur::create([
//       'email' => $request->email,
//       'pass' => Hash::make($request->pass),
//   ]);
//   auth()->attempt($request->only('email','pass'));


  
//     // Générer un jeton d'authentification
//     $token = $user->createToken('auth_token')->plainTextToken;

//     return response()->json([
//         'access_token' => $token,
//         'token_type' => 'Bearer',
//     ]);  

 $data=$request->validated();

$user = Utilisateur::create([
    'Nom_util' =>$data['Nom_util'],
    'email' => $data['email'],
    'password' => Hash::bcrypt($data['password']),
]);

$token  =$user->createToken('main')->plainTextToken;

return response()->json([
    'user'=>$user,
    'token'=>$token
]);


}
     


public function login(LoginRequest $request)
{
    // $request->validate([
    //     'email' => 'required|string|email',
    //     'pass' => 'required|string',
    // ]);

    // if (!Auth::attempt($request->only('email', 'pass'))) {
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }

    // return response()->json(['message' => 'User logged in']);

    $data=$request->validated();
    if(!Auth::attempt($data)){
        return response(['message'=>'email ou mot de passe incorrect']);
    }
    $user=Auth::user();
    $token  =$user->createToken('main')->plainTextToken;

return response()->json([
    'user'=>$user,
    'token'=>$token
]);
}


public function logout(Request $request)
{
    Auth::logout();
    return response()->json(['message' => 'User logged out']);
}

public function user(Request $request)
{
    return response()->json(Auth::user());
}










      // Fonction pour la connexion
    // public function logks(Request $request)
    // {
    //     // Valider les données de la requête
    //     $validator = Utilisateur::make($request->all(), [
    //         'email' => 'required|email',
    //         'pass' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     // Vérifier les informations d'identification
    //     if (!Auth::attempt($request->only('email', 'pass'))) {
    //         return response()->json(['error' => 'Informations de connexion invalides'], 401);
    //     }

    //     $user = Auth::user();
    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }

/////////////////////////////////////////////////////////////////////////////

   
  
//    recuperation
   public function recuperation()
    {
        $utilisateurs = Utilisateur::all();
        return response()->json($utilisateurs);
    }
    //requete nombre des contribuable 06/08/2024
    public function COUNT(){
        $utilisateur=Utilisateur::count();
        dd($utilisateur);
        return response()->json($utilisateur);
    }
}
