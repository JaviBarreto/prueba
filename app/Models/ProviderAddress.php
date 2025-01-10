<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'provider_addresses';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'provider_id',
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

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}