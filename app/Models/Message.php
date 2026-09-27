<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'expediteur_type',
        'expediteur_id',
        'contenu',
        'lu',
        'lu_at',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'lu_at' => 'datetime',
    ];

    // ============ RELATIONS ============

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Relation polymorphique (l'expéditeur peut être une Ame ou un User)
     */
    public function expediteur()
    {
        return $this->morphTo();
    }

    // ============ SCOPES ============

    public function scopeNonLus($query)
    {
        return $query->where('lu', false);
    }

    // ============ MÉTHODES UTILITAIRES ============

    /**
     * Marque le message comme lu
     */
    public function marquerLu(): void
    {
        if (!$this->lu) {
            $this->update([
                'lu' => true,
                'lu_at' => now(),
            ]);
        }
    }

    /**
     * Nom complet de l'expéditeur
     */
    public function getNomExpediteurAttribute(): string
    {
        if ($this->expediteur_type === 'ame') {
            $ame = Ame::find($this->expediteur_id);
            return $ame ? $ame->nom : 'Âme inconnue';
        } elseif ($this->expediteur_type === 'user') {
            $user = User::find($this->expediteur_id);
            return $user ? $user->nom : 'Responsable inconnu';
        }
        return 'Inconnu';
    }
}