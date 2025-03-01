<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function detailCommandes()
    {
        return $this->hasMany(DetailCommande::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

    public function mode_reglement()
    {
        return $this->belongsTo(ModeReglement::class);
    }

    public function getTotalAttribute()
    {
        return $this->detailCommandes->sum(function ($detailCommande) {
            return $detailCommande->quantite * $detailCommande->prix_ht * (1 + $detailCommande->tva / 100);
        });
    }
}
