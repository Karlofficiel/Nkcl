<?php

namespace App\Http\Controllers;

use App\Models\Taches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TachesController extends Controller
{
        // Affiche le formulaire de création
    public function create()
    {
        return view('formtache'); // Crée une vue resources/views/taches/create.blade.php
    }

    // Enregistre une nouvelle tâche en BD
    public function store(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string|unique:taches,nomtache',
            'description' => 'required|string',
            'nomemployer' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Taches::create([
            'nomtache' => $request->nomtache,
            'description' => $request->description,
            'nomemployer' => $request->nomemployer,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->back()->with('success', 'Tâche crée avec succès.');
    }

     public function index()
    {
        $taches = Taches::all();
        return view('tabtache', compact('taches'));
    }
    public function destroy($id)
    {
        $taches = Taches::findOrFail($id); // Recherche ou erreur 404
        $taches->delete(); // Supprime la tâche

        return redirect()->back()->with('success', 'Tâche supprimée avec succès.');
    }
      public function pagination()
    {
        // 5 tâches par page (modifiable)
        $taches = Taches::paginate(4);

        return view('tabtache', compact('taches'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Taches::query();

        if ($search) {
            // Recherche simple par nom de tâche (nomtache) avec LIKE
            $query->where('nomtache', 'LIKE', "%{$search}%");
        }
         $taches = $query->paginate(4); 

        return view('tabtache', compact('taches'));
    }

}
