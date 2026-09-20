<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecon_id',
        'question',
        'options',
        'bonne_reponse',
        'explication',
        'points',
    ];

    protected $casts = [
        'options' => 'array',
        'bonne_reponse' => 'integer',
        'points' => 'integer',
    ];

    public function lecon()
    {
        return $this->belongsTo(Lecon::class);
    }

    public function reponses()
    {
        return $this->hasMany(ReponseAme::class);
    }
}