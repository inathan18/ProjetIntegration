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
        'etat',           
        'modifie_par',
        'raison_refus',
        'modifications',
    ];

    public function getRaisonRefusAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return null;
        }
    }

    public function setRaisonRefusAttribute($value)
    {
        $this->attributes['raison_refus'] = Crypt::encryptString($value);
    }

    protected $casts = [
        'modifications' => 'array',
    ];
}
