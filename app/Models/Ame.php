<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ame extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'sexe',
        'age',
        'adresse',
        'date_conversion',
        'campagne_id',
        'type_decision',
        'latitude',
        'longitude',
        'assigne_a',
        'cellule_id',
        'image',
        'suivi',
        'derniere_interaction',
    ];

    protected $casts = [
        'date_conversion' => 'date',
        'age' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'derniere_interaction' => 'date',
        'suivi' => 'boolean',
    ];

    protected $with = ['campagne', 'encadreur', 'cellule'];

    // Relations
    public function campagne()
    {
        return $this->belongsTo(Campagne::class);
    }

    public function encadreur()
    {
        return $this->belongsTo(User::class, 'assigne_a');
    }

    public function cellule()
    {
        return $this->belongsTo(Cellule::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function etapesValidees()
    {
        return $this->hasMany(EtapeValidee::class);
    }

    // Accesseurs
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Si c'est une URL externe, la retourner directement
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            // Sinon, c'est un chemin local
            return asset('storage/' . $this->image);
        }
        return null;
    }

    public function getPositionAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude
            ];
        }
        return null;
    }

    public function getEstLocaliseAttribute()
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    // Scopes
    public function scopePourCampagne($query, $campagneId)
    {
        return $query->where('campagne_id', $campagneId);
    }

    public function scopePourEncadreur($query, $userId)
    {
        return $query->where('assigne_a', $userId);
    }

    public function scopeAvecPosition($query)
    {
        return $query->whereNotNull('latitude')->whereNotNull('longitude');
    }

    public function scopeSuivis($query)
    {
        return $query->where('suivi', true);
    }

    public function scopeNonSuivis($query)
    {
        return $query->where('suivi', false);
    }
}