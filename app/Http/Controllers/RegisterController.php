<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Utilisateur;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }
    
   public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:utilisateurs,email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Vérifier si c'est le premier utilisateur
    $isFirstUser = Utilisateur::count() === 0;

    $user = Utilisateur::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $isFirstUser ? 'admin' : 'employer',  // rôle selon condition
    ]);

    return redirect('/login')->with('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
}

}
