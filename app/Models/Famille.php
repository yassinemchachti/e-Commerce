<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    use HasFactory;
    protected $guarded = ['id','_token'];



    public function sousfamilles()
    {
        return $this->hasMany(SousFamille::class);
    }
}
