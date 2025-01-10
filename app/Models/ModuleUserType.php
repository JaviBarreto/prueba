<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleUserType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'module_user_types';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'view',
        'edit',
        'module_id',
        'user_type_id',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
