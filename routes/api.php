<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Entreprise;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\CompteController; // Correction ici


// Route::middleware('cors')->group(function () {
   
//     Route::apiResource('entreprises', EntrepriseController::class);
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Routeur pour les cruds d'utilisateur
Route::get('/utilisateurs',[UtilisateurController::class,'Util']);
Route::get('/utilisateurs',[UtilisateurController::class,'recuperation']);
Route::post('/utilisateurs',[UtilisateurController::class,'login']);
Route::put('/utilisateurs/{id}',[UtilisateurController::class,'modifier']);
Route::delete('/utilisateurs/{id}',[UtilisateurController::class,'supprimer']);

//Routeur pour les cruds du TYpe
Route::post('/type_entreprises',[TypeController::class,'store']);

//Routeur pour les Compte 


Route::post('/comptes',[CompteController::class,'store']);
Route::get('/comptes',[CompteController::class,'recuperation']);
Route::get('/comptes/{id}', [CompteController::class, 'getCompteById']); // Pour récupérer les détails d'un compte spécifique





//Router pour transaction
Route::get('/transactions',[TransactionController::class,'AJT']);
Route::delete('/transactions/{id}',[TransactionController::class,'SP']);
