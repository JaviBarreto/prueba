<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_items';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'created_at',
        'updated_at'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
