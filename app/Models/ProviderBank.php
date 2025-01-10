<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderBank extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'provider_banks';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'provider_id',
        'bank_name',
        'account_number',
        'account_type',
        'created_at',
        'updated_at'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
