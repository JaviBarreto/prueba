<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'cost',
        'price_cost',
        'price_unit',
        'price_wholesale',
        'price_special',
        'color_id',
        'status_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function color()
    {
        return $this->belongsTo(Parameter::class, 'color_id');
    }

    public function status()
    {
        return $this->belongsTo(Parameter::class, 'status_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productOffers()
    {
        return $this->hasMany(ProductOffer::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function inventories()
    {
        return $this->hasMany(ProductInventory::class);
    }
}
