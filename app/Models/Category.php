<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
