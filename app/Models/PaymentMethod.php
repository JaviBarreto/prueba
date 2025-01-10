<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_methods';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
