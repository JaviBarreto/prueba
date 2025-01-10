<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAcountClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bank_acount_clients';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'client_id',
        'bank_id',
        'account_type_id',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
