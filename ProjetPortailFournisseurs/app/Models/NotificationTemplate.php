<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NotificationTemplate extends Model
{
    use HasFactory;
    protected $table = "mail_templates";
    protected $fillable = ['type', 'name', 'subject', 'line1', 'line2', 'line3'];
}
