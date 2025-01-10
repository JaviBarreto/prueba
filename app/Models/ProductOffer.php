<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_offers';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'product_id',
        'offer_id',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
