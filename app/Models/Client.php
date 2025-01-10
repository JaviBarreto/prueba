<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at'
    ];

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    // public function bankAccounts()
    // {
    //     return $this->hasMany(BankAccountClient::class);
    // }
}
