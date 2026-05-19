<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'statut',
        'client_id',
        'fournisseur_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_CONFIRMEE  = 'confirmee';
    const STATUT_LIVREE     = 'livree';
    const STATUT_ANNULEE    = 'annulee';

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }

    // Calculate total amount
    public function calculerTotal(): float
    {
        return $this->produits->sum(function ($produit) {
            return $produit->pivot->quantite * $produit->pivot->prix_unitaire;
        });
    }

    public function getStatutLabelAttribute(): string
    {
        return match ($this->statut) {
            self::STATUT_EN_ATTENTE => 'En attente',
            self::STATUT_CONFIRMEE  => 'Confirmée',
            self::STATUT_LIVREE     => 'Livrée',
            self::STATUT_ANNULEE    => 'Annulée',
            default                 => ucfirst($this->statut),
        };
    }

    public function getStatutBadgeAttribute(): string
    {
        return match ($this->statut) {
            self::STATUT_EN_ATTENTE => 'warning',
            self::STATUT_CONFIRMEE  => 'primary',
            self::STATUT_LIVREE     => 'success',
            self::STATUT_ANNULEE    => 'danger',
            default                 => 'secondary',
        };
    }
}
