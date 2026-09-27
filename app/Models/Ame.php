<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Ame extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'password',
        'pin_modifie',
        'derniere_connexion',
        'sexe',
        'age',
        'adresse',
        'date_conversion',
        'campagne_id',
        'zone_id',
        'type_decision',
        'latitude',
        'longitude',
        'assigne_a',
        'cellule_id',
        'image',
        'suivi',
        'derniere_interaction',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_conversion' => 'date',
        'age' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'derniere_interaction' => 'date',
        'suivi' => 'boolean',
        'pin_modifie' => 'boolean',
        'derniere_connexion' => 'datetime',
    ];

    protected $with = ['campagne', 'encadreur', 'cellule'];

    // ============ RELATIONS ============

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

    public function progressions()
    {
        return $this->hasMany(ProgressionAme::class);
    }

    public function reponses()
    {
        return $this->hasMany(ReponseAme::class);
    }

    // ✅ NOUVEAU : conversations et messages
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'expediteur');
    }

    // ============ ACCESSORS ============

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
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

    // ============ SCOPES ============

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