<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecon extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_id',
        'titre',
        'contenu',
        'versets_cles',
        'ordre',
        'duree_minutes',
    ];

    protected $casts = [
        'ordre' => 'integer',
        'duree_minutes' => 'integer',
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function reponses()
    {
        return $this->hasMany(ReponseAme::class);
    }
}