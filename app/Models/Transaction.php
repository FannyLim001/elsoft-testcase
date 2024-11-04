<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'company',
        'code',
        'date',
        'account_id',
        'note'
    ];

    public function transactionAccount()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }
}
