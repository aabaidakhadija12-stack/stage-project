<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'dateEmission',
        'commande_id',
    ];

    protected $casts = [
        'dateEmission' => 'date',
        'montant'      => 'decimal:2',
    ];

    // Relationships
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
