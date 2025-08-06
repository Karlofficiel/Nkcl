<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
  

public function login(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

    // Chercher l'utilisateur par email
    $user = Utilisateur::where('email', $request->email)->first();

    // Vérifier l'existence et le mot de passe
    if (!$user || !Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
    }

    // Vérifier si l'utilisateur est bloqué
    if ($user->est_bloque) {
        return redirect()->back()->with('error', 'Votre compte est bloqué.');
    }

    // Connexion réussie via Auth
    Auth::login($user);

    // Récupérer le nom (ou nom d'utilisateur) - adapte si besoin
    $nomUtilisateur = $user->name ?? $user->nom ?? 'Utilisateur';

    // Redirection selon rôle
    if ($user->role === 'admin') {
        return redirect()->route('statistique.utilisateurs.index')->with('success', "Bienvenue admin, $nomUtilisateur !");
    } else {
        return redirect()->route('employer.statistiques')->with('success', "Bienvenue, $nomUtilisateur !");
    }
}

}
