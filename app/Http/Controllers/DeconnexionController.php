<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class DeconnexionController extends Controller
{
    public function deconnexion(){
        Auth::logout();
        return redirect('/login');
    }
}
