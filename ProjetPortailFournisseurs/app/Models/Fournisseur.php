<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Fournisseur extends Authenticatable implements MustVerifyEmail
{
    use Notificable;
    public function routeNotificationForMail($notification){
        return $this->email;
    }
    use HasFactory;
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
        'password',
        'raisonRefus',
        'is_email_verified',
        'personneContact',
        'statut'
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
        'raisonRefus' => 'encrypted',
        'email_verified_at' => 'datetime',

    ];

    
}


