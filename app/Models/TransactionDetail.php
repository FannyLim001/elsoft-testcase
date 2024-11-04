<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    protected $primaryKey = 'transaction_detail_id';

    protected $fillable = [
        'transaction_id',
        'master_item_id',
        'quantity',
        'item_unit_id',
        'note'
    ];

    public function transactionId()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function transactionItem()
    {
        return $this->belongsTo(MasterItem::class, 'master_item_id', 'id');
    }

    public function transactionItemUnit()
    {
        return $this->belongsTo(ItemUnit::class, 'item_unit_id', 'item_unit_id');
    }
}
