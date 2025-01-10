<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'raw_material_transfers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'quantity',
        'raw_material_id',
        'origin_storage_id',
        'destination_storage_id',
        'created_at',
        'updated_at'
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function storageOrigin()
    {
        return $this->belongsTo(Storage::class, 'origin_storage_id');
    }

    public function storageDestination()
    {
        return $this->belongsTo(Storage::class, 'destination_storage_id');
    }
}
