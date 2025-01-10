<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_types';

    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_user_types');
    }
}