<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'raw_materials';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'code',
        'provider_id',
        'unit_type_id',
        'created_at',
        'updated_at'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function unitType()
    {
        return $this->belongsTo(Parameter::class, 'unit_type_id');
    }

    public function rawMaterialInventory()
    {
        return $this->hasMany(RawMaterialInventory::class);
    }
}
