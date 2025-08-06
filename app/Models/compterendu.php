<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compterendu extends Model
{
    use HasFactory;
    protected $table = 'compterendus';
    protected $fillable = ['nom','fichier',];
}
