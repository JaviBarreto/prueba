<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_inventories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'storage_id',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
