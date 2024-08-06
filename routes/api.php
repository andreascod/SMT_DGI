<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Entreprise;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RapportController;


// Route::middleware('cors')->group(function () {
   
//     Route::apiResource('entreprises', EntrepriseController::class);
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Routeur pour les cruds d'utilisateur
Route::get('/utilisateurs',[UtilisateurController::class,'Util']);
Route::get('/utilisateurs/recuperer',[UtilisateurController::class,'recuperation']);
Route::get('/logks',[LoginController::class,'login']);
Route::put('/utilisateurs/{id}',[UtilisateurController::class,'modifier']);
Route::delete('/utilisateurs/{id}',[UtilisateurController::class,'supprimer']);


/////////////////////Mbol ts nampiasaina any @ front
Route::get('/counts',[UtilisateurController::class,'COUNT']);
//Routeur pour les cruds du TYpe
Route::post('/type_entreprises',[TypeController::class,'store']);

//Routeur pour les Compte 


Route::post('/comptes',[CompteController::class,'store']);
Route::get('/comptes',[CompteController::class,'recuperation']);
Route::get('/comptes/{id}', [CompteController::class, 'getCompteById']); // Pour récupérer les détails d'un compte spécifique
Route::get('/comptes',[CompteController::class,'Affiche']);
Route::get('/comptes/{id_compte}', [CompteController::class, 'declarer']); 
Route::delete('comptes/delete/{id}',[CompteController::class,'SUPCompte']);
Route::get('compte/affichage',[CompteController::class,'AffichageTableau']);



//Router pour transaction
Route::post('/transactions',[TransactionController::class,'store']);
Route::get('/transactions/trans', [TransactionController::class, 'getTransactions']);
Route::get('/transactions/get',[TransactionController::class,'afficheRec']);

// mbola tsy nampiasaina any @ front
Route::get('/transaction/trans/{id}', [TransactionController::class, 'getTransaction']);
Route::get('/transaction/recuperation',[TransactionController::class,'recuperationTransaction']);

Route::get('/Rapport', [RapportController::class, 'generateFinancialReport']);