<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInformation extends Model
{
    use HasFactory;
    protected $table = "financial_informations";
    protected $fillable = [
'noTps',
'noTvq',
'conditionPaiement',
'devise',
'modeCommunication',

    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }
}
