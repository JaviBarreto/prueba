<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'client_addresses';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'client_id',
        'reference',
        'state',
        'city',
        'colony',
        'postal_code',
        'address',
        'telephone',
        'rfc',
        'status',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
