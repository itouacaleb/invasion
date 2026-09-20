<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressionAme extends Model
{
    use HasFactory;

    protected $table = 'progression_ames';

    protected $fillable = [
        'ame_id',
        'niveau_id',
        'statut',
        'lecons_completees',
        'score_total',
        'score_requis',
        'date_debut',
        'date_completion',
    ];

    protected $casts = [
        'statut' => 'string',
        'lecons_completees' => 'integer',
        'score_total' => 'integer',
        'score_requis' => 'integer',
        'date_debut' => 'datetime',
        'date_completion' => 'datetime',
    ];

    public function ame()
    {
        return $this->belongsTo(Ame::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}