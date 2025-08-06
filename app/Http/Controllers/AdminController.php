<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class AdminController extends Controller
{
    // Affiche la liste des utilisateurs
    public function index()
    {
        $utilisateurs = Utilisateur::paginate(2);
        return view('statistique', compact('utilisateurs'));
    }
    public function search(Request $request)
{
    $query = Utilisateur::query();

    // Si l'utilisateur tape un mot-clé de recherche
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;

        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    // Pagination avec conservation des paramètres de recherche
    $utilisateurs = $query->paginate(2)->withQueryString();

    return view('statistique', compact('utilisateurs'));
}

    // Supprimer un utilisateur
    public function supprimer($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('statistique.utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Bloquer un utilisateur
    public function bloquer($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->est_bloque = true;
        $utilisateur->save();

        return redirect()->route('statistique.utilisateurs.index')->with('success', 'Utilisateur bloqué avec succès.');
    }

    // Débloquer un utilisateur
    public function debloquer($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->est_bloque = false;
        $utilisateur->save();

        return redirect()->route('statistique.utilisateurs.index')->with('success', 'Utilisateur débloqué avec succès.');
    }
}
