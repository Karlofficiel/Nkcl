<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    // Optionnel car Eloquent comprend automatiquement le nom de table "projets"
    // protected $table = 'projets';

    protected $fillable = [
        'nameprojet',
        'description',
        'nameemployer1',
        'nameemployer2',
        'date_debut',
        'date_fin'
    ];
}

