<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Fournisseur extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table = "fournisseurs";
    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'country',
        'phone',
        'postCode',
        'unspsc',
        'website',
        'email',
        'files',
        'neq',
        'rbq',
        'typesRbq',
        'password',
        'personneContact',
        'statut',
        'financial_information_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'phone' => 'array',
        'files' => 'array',
        'unspsc' => 'array',
        'typesRbq' => 'array',
        'personneContact' => 'array',
        'raisonRefus' => 'encrypted'

    ];

    public function financialInformation(){
        return $this->hasOne(FinancialInformation::class);
    }
}


