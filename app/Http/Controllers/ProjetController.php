<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
   public function create()
    {
        return view('formprojet');
    }

    // Enregistre un nouveau projet
    public function store(Request $request)
    {
        $request->validate([
            'nameprojet' => 'required|string|max:255',
            'description' => 'required|string',
            'nameemployer1' => 'required|string|max:255',
            'nameemployer2' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Projet::create($request->all());

        return redirect()->back()->with('success', 'Projet créé avec succès.');
    }

//     // Dans ProjetController
//   public function index()
//     {
//         $projets = Projet::all(); // récupère tous les projets
//         return view('tabprojet', compact('projets')); // passe la variable à la vue
//     }

    public function destroy($id)
    {
        $projets = Projet::findOrFail($id);
        $projets->delete();

        return redirect()->back()->with('success', 'Projet supprimé avec succès.');
    }

   

    public function index()
        {
            $projets = Projet::paginate(4); // ✅ pagine correctement
            return view('tabprojet', compact('projets'));
        }

        public function search(Request $request)
        {
            $query = $request->input('search');

            $projets = Projet::where('nameprojet', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhere('nameemployer1', 'like', "%{$query}%")
                            ->orWhere('nameemployer2', 'like', "%{$query}%")
                            ->paginate(4);

            return view('tabprojet', compact('projets'));
        }

}
