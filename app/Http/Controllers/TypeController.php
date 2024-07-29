<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeEntreprise;

class TypeController extends Controller
{
    public function store(Request $request){
        $request->validate([
          'Nom_type'=>'required|string|max:50',
        ]);
        $type=TypeEntreprise::create($request->all());
        return response()->json($type,201);
    }
}
