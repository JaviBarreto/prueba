<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parameters';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'value',
        'system',
        'created_at',
        'updated_at'
    ];

    public function productColor()
    {
        return $this->hasMany(Product::class, 'color_id');
    }

    public function productStatus()
    {
        return $this->hasMany(Product::class, 'status_id');
    }

    public function sales()
    {
        return $this->hasMany(Product::class, 'status_id');
    }

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class, 'unit_type_id');
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class,'method_id');
    }

    public function bankAcountClients()
    {
        return $this->hasMany(BankAcountClient::class,'bank_id');
    }
}
