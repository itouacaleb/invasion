<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReponseAme extends Model
{
    use HasFactory;

    protected $table = 'reponses_ames';

    protected $fillable = [
        'ame_id',
        'question_id',
        'lecon_id',
        'reponse_donnee',
        'est_correcte',
        'points_obtenus',
        'date_reponse',
    ];

    protected $casts = [
        'reponse_donnee' => 'integer',
        'est_correcte' => 'boolean',
        'points_obtenus' => 'integer',
        'date_reponse' => 'datetime',
    ];

    public function ame()
    {
        return $this->belongsTo(Ame::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function lecon()
    {
        return $this->belongsTo(Lecon::class);
    }
}