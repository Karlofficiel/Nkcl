<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tacheemployer extends Model
{
    use HasFactory;

    protected $table = 'tacheemployers';
    protected $fillable = [
        'nomtache',
        'description',
        'date_debut',
        'date_fin',
        'statut',
    ];
}
