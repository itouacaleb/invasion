<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'ordre',
        'icone',
        'couleur',
        'is_actif',
    ];

    protected $casts = [
        'is_actif' => 'boolean',
        'ordre' => 'integer',
    ];

    public function lecons()
    {
        return $this->hasMany(Lecon::class)->orderBy('ordre');
    }

    public function progressions()
    {
        return $this->hasMany(ProgressionAme::class);
    }
}