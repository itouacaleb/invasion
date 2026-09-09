<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Campagne extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'date_debut', 
        'date_fin', 
        'zone_id', 
        'description'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Relations
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function ames()
    {
        return $this->hasMany(Ame::class);
    }

    public function statistiques()
    {
        return $this->hasMany(Statistique::class);
    }

    /**
     * Vérifier si une date est dans la période de la campagne
     */
    public function isDateInPeriod($date)
    {
        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        
        // Vérifier que la date est après la date de début
        if ($date->lt($this->date_debut)) {
            return false;
        }
        
        // Si une date de fin est définie, vérifier que la date est avant
        if ($this->date_fin && $date->gt($this->date_fin)) {
            return false;
        }
        
        return true;
    }

    /**
     * Obtenir la période formatée pour l'affichage
     */
    public function getPeriodeTextAttribute()
    {
        $debut = $this->date_debut ? $this->date_debut->format('d/m/Y') : 'N/A';
        if ($this->date_fin) {
            return $debut . ' - ' . $this->date_fin->format('d/m/Y');
        }
        return 'À partir du ' . $debut;
    }

    /**
     * Obtenir la période au format ISO
     */
    public function getPeriodeIsoAttribute()
    {
        return [
            'date_debut' => $this->date_debut ? $this->date_debut->toDateString() : null,
            'date_fin' => $this->date_fin ? $this->date_fin->toDateString() : null,
        ];
    }

    /**
     * Vérifier si la campagne est active (en cours)
     */
    public function getIsActiveAttribute()
    {
        $now = Carbon::now();
        return $this->date_debut <= $now && ($this->date_fin === null || $this->date_fin >= $now);
    }

    /**
     * Obtenir le nombre total d'âmes pour cette campagne
     */
    public function getTotalAmesAttribute()
    {
        return $this->ames()->count();
    }
}