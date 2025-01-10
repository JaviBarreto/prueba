<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialInventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'raw_material_inventories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'raw_material_id',
        'quantity',
        'created_at',
        'updated_at'
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
