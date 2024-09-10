<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FournisseurVerify extends Model
{
    use HasFactory;

    public $table = "fournisseurs_verify";

    protected $fillable = [
        'fournisseur_id',
        'token',
    ];

    public function fournisseur(){

        return $this->belongsTo(Fournisseur::class);
    }
}
