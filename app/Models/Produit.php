<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];	



    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function sous_famille()
    {
        return $this->belongsTo(SousFamille::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }


    public function detail_commandes()
    {
        return $this->hasMany(DetailCommande::class);
    }



}
