<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'prix',
        'quantiteStock',
        'description',
    ];

    protected $casts = [
        'prix'          => 'decimal:2',
        'quantiteStock' => 'integer',
    ];

    // Relationships
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    // Helpers
    public function isEnStock(): bool
    {
        return $this->quantiteStock > 0;
    }

    public function ajouterStock(int $quantite): void
    {
        $this->increment('quantiteStock', $quantite);
    }

    public function retirerStock(int $quantite): void
    {
        if ($this->quantiteStock >= $quantite) {
            $this->decrement('quantiteStock', $quantite);
        }
    }
}
