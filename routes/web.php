<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TachesController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\AnnoncesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\employerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessagerieController;


// Routes pour l'enregistrement
Route::get('/', [RegisterController::class, 'index'])->name('register.index');
Route::post('store', [RegisterController::class, 'store'])->name('register.store');

// Routes pour la connexion
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.store');


        // Routes pour la gestion des tâches
        Route::get('/formtache', [TachesController::class, 'create'])->name('taches.create');
        Route::post('/formtache', [TachesController::class, 'store'])->name('taches.store');
        Route::get('/tabtache', [TachesController::class, 'index'])->name('taches.index');
        Route::get('/tabtache', [TachesController::class, 'pagination'])->name('taches.pagination');
        Route::get('/taches', [TachesController::class, 'search'])->name('taches.search');
        Route::delete('/taches/{id}', [TachesController::class, 'destroy'])->name('taches.destroy');

        // Routes pour la gestion des projets
        Route::get('/formprojet', [ProjetController::class, 'create'])->name('projet.create');
        Route::post('/formprojet', [ProjetController::class, 'store'])->name('projet.store');
        Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
        Route::get('/projets/search', [ProjetController::class, 'search'])->name('projets.search');
        Route::delete('/projets/{id}', [ProjetController::class, 'destroy'])->name('projets.destroy');

        // Routes pour la gestion des annonces
        Route::get('/formannonce', [AnnoncesController::class, 'create'])->name('annonces.create');
        Route::post('/annonces', [AnnoncesController::class, 'store'])->name('annonces.store');
        Route::get('/mesannonces', [AnnoncesController::class, 'index'])->name('annonce.index');
        Route::delete('/annonce/{id}', [AnnoncesController::class, 'destroy'])->name('annonce.delete');

        // Routes pour la gestion du profil utilisateur
        Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
        Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
        Route::delete('/profil/delete', [ProfilController::class, 'destroy'])->name('profil.delete');

        // Groupe de routes pour la section statistique
        Route::prefix('statistique')->group(function () {
            // Page principale : liste des utilisateurs
            Route::get('/', [AdminController::class, 'index'])->name('statistique.utilisateurs.index');
            // search utilisateurs
            Route::get('/statistique/utilisateurs', [AdminController::class, 'search'])->name('statistique.utilisateurs');
            // Supprimer un utilisateur
            Route::get('/utilisateur/{id}/supprimer', [AdminController::class, 'supprimer'])->name('statistique.utilisateur.supprimer');
            // Bloquer un utilisateur
            Route::get('/utilisateur/{id}/bloquer', [AdminController::class, 'bloquer'])->name('statistique.utilisateur.bloquer');
            // Débloquer un utilisateur
            Route::get('/utilisateur/{id}/debloquer', [AdminController::class, 'debloquer'])->name('statistique.utilisateur.debloquer');
        });

        Route::get('/messages', [MessageController::class, 'index'])->name('messagerie.index');
        Route::get('/messages/{user}', [MessageController::class, 'getMessages'])->name('messages.get');
        Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
        Route::delete('/messages/{id}/delete', [MessageController::class, 'destroy'])->name('messages.destroy');


        // Route pour la déconnexion
        Route::get('/deconnexion', [DeconnexionController::class, 'deconnexion'])->name('deconnexion');

// End routes Admin


// ROUTES POUR L'EMPLOYE


        Route::get('/tachesemployer', [employerController::class, 'index'])->name('employer.taches');
        Route::post('/employer/tachesemployer', [employerController::class, 'store'])->name('employer.taches.store');

        Route::get('/statistiques', [employerController::class, 'statistiques'])->name('employer.statistiques');
        Route::get('/employer/taches/{id}/statut/{statut}', [employerController::class, 'changerStatut'])->name('employer.taches.statut');
        Route::get('/employer/taches/{id}/supprimer', [employerController::class, 'supprimer'])->name('employer.taches.supprimer');

        // Affichage de la messagerie pour l'employé
        Route::get('/employer/messagerie', [MessagerieController::class, 'indexemployer'])->name('employer.messagerie');
        // Récupérer les messages via AJAX pour un utilisateur donné
        Route::get('/messages/{user}', [MessagerieController::class, 'getMessages'])->name('messages.get');
        // Envoyer un message
        Route::post('/messages/send', [MessagerieController::class, 'sendMessage'])->name('messages.send');
        // Supprimer un message
        Route::delete('/messages/{id}/delete', [MessagerieController::class, 'destroy'])->name('messages.delete');

        // Routes pour la gestion du profil employeur
          Route::get('/employer/profilemployer', [employerController::class, 'edit'])->name('employer.profil');
          Route::post('/employer/profil', [employerController::class, 'updateProfil'])->name('employer.profil.update');
          Route::post('/employer/profil/password', [employerController::class, 'updatePassword'])->name('employer.profil.password');
          Route::delete('/employer/profil', [employerController::class, 'destroy'])->name('employer.profil.delete');

        //Routes pour les compte-rendu
          Route::get('/employer/compte-rendu', [employerController::class, 'compteRendu'])->name('employer.compte-rendu');
          Route::post('/employer/compte-rendu', [employerController::class, 'store_rendu'])->name('employer.compte-rendu.store');

        // Route pour afficher les annonces de l'employer
        Route::get('/employer/annonces', [employerController::class, 'annonces'])->name('employer.annonces');







         Route::get('/taches-assignees', function () {
            return view('employer.taches-assignees');
        });

       




