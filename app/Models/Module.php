<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'modules';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'route',
        'icon',
        'status',
        'colony',
        'department',
        'position',
        'created_at',
        'updated_at'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_user_types');
    }
}
