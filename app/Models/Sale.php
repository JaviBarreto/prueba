<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sales';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'order_id',
        'payment_status',
        'payment_method',
        'total',
        'client_id',
        'parameter_id',
        'client_address_id',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function clientAddress()
    {
        return $this->belongsTo(ClientAddress::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function status()
    {
        return $this->belongsTo(Parameter::class, 'status_id');
    }
}
