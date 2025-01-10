<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';

    protected $fillable = [
        'id',
        'name',
        'contact_name',
        'email',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function bankAccounts()
    {
        return $this->hasMany(ProviderBank::class);
    }

    public function addresses()
    {
        return $this->hasMany(ProviderAddress::class);
    }

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class);
    }
}
