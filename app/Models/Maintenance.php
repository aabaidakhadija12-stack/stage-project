<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'type',
        'description',
        'produit_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationships
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
