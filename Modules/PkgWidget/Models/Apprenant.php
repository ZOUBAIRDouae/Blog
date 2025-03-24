<?php

namespace Modules\PkgWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Apprenant extends Model
{
  
   // Spécifier la table associée au modèle
   protected $table = 'apprenants';

   // Spécifier les champs qui peuvent être remplis massivement
   protected $fillable = [
       'nom',
       'email',
       'actif',
   ];

   // Définir les types de données pour certaines colonnes
   protected $casts = [
       'actif' => 'boolean',
   ];






}
