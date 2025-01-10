<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'storages';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
