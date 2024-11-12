<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Historique extends Model
{
    use HasFactory;

    protected $table = 'historique_etats';

    protected $fillable = [
        'fournisseur_id',
        'statut',           
        'modifie_par',
        'raisonRefus',
        'modifications',
    ];

    public function getRaisonRefusAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            \Log::error('Erreur de décryptage : ' . $e->getMessage());
            return null;
        }
    }
    

    public function setRaisonRefusAttribute($value)
    {
        $this->attributes['raisonRefus'] = Crypt::encryptString($value);
    }

    protected $casts = [
        'modifications' => 'array',
    ];
}
