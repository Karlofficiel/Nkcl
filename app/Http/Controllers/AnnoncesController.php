<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use Illuminate\Http\Request;

class AnnoncesController extends Controller
{
    public function create(){
        return view('formannonce');
    }
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Enregistre l'image dans le dossier storage/app/public/images
          $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }
        

        // Crée une entrée en base avec le chemin
        Annonces::create([
            'description' => $request->description,
            'image' => $path,
            'utilisateur_id' => auth()->id(), // Associe l'annonce à l'utilisateur connecté
        ]);
            
        return redirect()->back()->with('success', 'Annonce publiée avec succès.');
    }

      public function index()
    {
        $annonces = Annonces::paginate(3); // car ton modèle s'appelle Annonces
        return view('mesannonces', compact('annonces'));
    }


    // Suppression d'une annonce
    public function destroy($id)
    {
        $annonce = Annonces::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($annonce->image && \Storage::exists('public/annonces/' . $annonce->image)) {
            \Storage::delete('public/annonces/' . $annonce->image);
        }

        $annonce->delete();

        return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
    }
}
