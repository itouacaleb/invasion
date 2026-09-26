<?php
// app/Models/EtapeValidee.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtapeValidee extends Model
{
    // ✅ FIX : Forcer le nom exact de la table en base
    protected $table = 'etapes_validees';

    protected $fillable = [
        'ame_id',
        'parcours_spirituel_id',
        'valide_par',
        'date_validation',
        'commentaires',
    ];

    protected $casts = [
        'date_validation' => 'date',
    ];

    // ============ RELATIONS ============
    public function ame()
    {
        return $this->belongsTo(Ame::class);
    }

    public function parcours()
    {
        return $this->belongsTo(ParcoursSpirituel::class, 'parcours_spirituel_id');
    }

    public function validateur()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }
}