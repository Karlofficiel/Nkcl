<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tacheemployer;
use App\Models\utilisateur;
use App\Models\Annonces;
use App\Models\compterendu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class employerController extends Controller
{
    public function index()
    {
        // Logique pour afficher la page d'accueil de l'employeur
        return view('employer.tachesemployer');
    }

    public function store(Request $request)
    {
       $request->validate([
            'nomtache' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

         $validated['statut'] = 'en cours'; // Définir par défaut ici

        tacheemployer::create([
            'nomtache' => $request->nomtache,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'En cours', // ⬅️ Valeur par défaut
        ]);

        return redirect()->route('employer.statistiques')->with('success', 'Tâche créée avec succès.');
    }

    public function statistiques()
    {
        
        $totalTaches = TacheEmployer::count();

        // Statut "en cours"
        $tachesEnCours = TacheEmployer::where('statut', 'En cours')->count();

        // Tâches en retard : date_fin < aujourd'hui et statut != "Terminée"
        $aujourdhui = Carbon::today()->toDateString();

        $tachesEnRetard = TacheEmployer::where('date_fin', '<', $aujourdhui)
                            ->where('statut', '!=', 'Terminée')
                            ->count();

        $taches = TacheEmployer::paginate(3); // récupère toutes les tâches

        return view('employer.statistiques', compact('totalTaches', 'tachesEnCours', 'tachesEnRetard', 'taches'));
    }
     public function changerStatut($id, $nouveauStatut)

    {
        $tache = tacheemployer::findOrFail($id);
        $tache->statut = $nouveauStatut;
        $tache->save();

        return redirect()->back()->with('success', 'Statut mis à jour');
    }

    public function supprimer($id)
    {
        $tache = tacheemployer::findOrFail($id);
        $tache->delete();

        return redirect()->back()->with('success', 'Tâche supprimée');
    }
        
    public function edit()
    {
        return view('employer.profilemployer', ['user' => Auth::user()]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mot de passe actuel incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mot de passe mis à jour.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Compte supprimé.');
    }

    // Route pour afficher le compte rendu
    public function compteRendu()
    {
        return view('employer.compte-rendu');
    }
   public function store_rendu(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'fichier' => 'required|file|max:2048',
        ]);

        if ($request->hasFile('fichier')) {
            $nomFichier = time() . '_' . $request->file('fichier')->getClientOriginalName();
            $path = $request->file('fichier')->storeAs('uploads', $nomFichier, 'public');

            // ENREGISTRER DANS LA BASE
            compterendu::create([
                'nom' => $request->input('nom'),
                'fichier' => $path, // chemin relatif du fichier
            ]);

            return back()->with('success', 'Fichier envoyé avec succès !');
        }

        return back()->with('error', 'Erreur lors de l\'envoi du fichier.');
    }
      
    public function annonces()
    {
        // Récupère toutes les annonces dont l’auteur a le rôle "admin"
        $annonces = Annonces::whereHas('utilisateur', function ($query) {
            $query->where('role', 'admin');
        })->latest()->get();

        return view('employer.annoncesemployer', compact('annonces'));
    }

}


