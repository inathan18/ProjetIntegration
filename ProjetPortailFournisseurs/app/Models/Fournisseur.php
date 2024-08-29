<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class Fournisseur extends Authenticatable
{
    use HasFactory;
    use HasCompositePrimaryKey;
    protected $primaryKey = ['neq', 'email'];

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
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}


