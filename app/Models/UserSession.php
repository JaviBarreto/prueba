<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    protected $date = ['deleted_at'];

    protected $fillable = [
        'id_user',
        'ip',
        'created_at',
        'updated_at'
    ];
}
