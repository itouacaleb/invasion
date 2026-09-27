<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ame_id',
        'user_id',
        'pris_en_charge_par',
        'pris_en_charge_at',
        'dernier_message_at',
        'messages_non_lus_ame',
        'messages_non_lus_user',
    ];

    protected $casts = [
        'dernier_message_at' => 'datetime',
        'pris_en_charge_at' => 'datetime',
        'messages_non_lus_ame' => 'integer',
        'messages_non_lus_user' => 'integer',
    ];

    // ============ RELATIONS ============

    public function ame()
    {
        return $this->belongsTo(Ame::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referent()
    {
        return $this->belongsTo(User::class, 'pris_en_charge_par');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    public function dernierMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    // ============ SCOPES ============

    public function scopePourAme($query, $ameId)
    {
        return $query->where('ame_id', $ameId);
    }

    public function scopePourUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopePourReferent($query, int $userId)
    {
        return $query->where('pris_en_charge_par', $userId);
    }

    public function scopeOrphelines($query)
    {
        return $query->whereNull('pris_en_charge_par');
    }

    public function scopeRecentes($query)
    {
        return $query->orderBy('dernier_message_at', 'desc');
    }

    // ============ MÉTHODES UTILITAIRES ============

    /**
     * Trouve ou crée une conversation entre une âme et un user
     */
    public static function trouverOuCreer(int $ameId, int $userId): self
    {
        return self::firstOrCreate(
            ['ame_id' => $ameId, 'user_id' => $userId],
            ['dernier_message_at' => now()]
        );
    }

    /**
     * Récupère la conversation active d'une âme (peu importe l'admin)
     */
    public static function conversationActiveAme(int $ameId): ?self
    {
        return self::where('ame_id', $ameId)
            ->whereNotNull('pris_en_charge_par')
            ->orderBy('dernier_message_at', 'desc')
            ->first();
    }

    /**
     * La conversation est-elle prise en charge ?
     */
    public function estPriseEnCharge(): bool
    {
        return !is_null($this->pris_en_charge_par);
    }

    /**
     * La conversation est-elle orpheline (aucun référent) ?
     */
    public function estOrpheline(): bool
    {
        return is_null($this->pris_en_charge_par);
    }

    /**
     * L'admin donné est-il le référent ?
     */
    public function estReferent(int $userId): bool
    {
        return $this->pris_en_charge_par === $userId;
    }

    /**
     * Prendre en charge la conversation
     */
    public function prendreEnCharge(int $userId): bool
    {
        if ($this->estPriseEnCharge() && $this->pris_en_charge_par !== $userId) {
            return false;
        }

        $this->update([
            'user_id' => $userId,
            'pris_en_charge_par' => $userId,
            'pris_en_charge_at' => now(),
        ]);

        return true;
    }

    /**
     * Réassigne la conversation à un autre admin (superadmin)
     */
    public function reassigner(int $newUserId): void
    {
        $this->update([
            'user_id' => $newUserId,
            'pris_en_charge_par' => $newUserId,
            'pris_en_charge_at' => now(),
        ]);
    }

    /**
     * Incrémente le compteur non lus pour un côté
     */
    public function incrementerNonLus(string $cote): void
    {
        if ($cote === 'ame') {
            $this->increment('messages_non_lus_ame');
        } elseif ($cote === 'user') {
            $this->increment('messages_non_lus_user');
        }
    }

    /**
     * Réinitialise les non lus pour un côté
     */
    public function marquerLusPour(string $cote): void
    {
        if ($cote === 'ame') {
            $this->update(['messages_non_lus_ame' => 0]);
        } elseif ($cote === 'user') {
            $this->update(['messages_non_lus_user' => 0]);
        }
    }
}