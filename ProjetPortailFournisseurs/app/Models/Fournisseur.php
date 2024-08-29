<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class Fournisseur extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;
    protected $primaryKey = ['neq', 'email'];
}
