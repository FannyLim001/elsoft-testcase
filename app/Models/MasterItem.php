<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    use HasFactory;

    protected $table = 'master_item';

    protected $fillable = [
        'company',
        'item_type',
        'code',
        'title',
        'item_group_id',
        'item_account_id',
        'item_unit_id',
        'isActive'
    ];

    // Relationship with Items (assuming 'id' is primary key in Items)
    public function itemGroup()
    {
        return $this->belongsTo(Items::class, 'item_group_id', 'item_group_id');
    }

    // Relationship with ItemAccount
    public function itemAccount()
    {
        return $this->belongsTo(ItemAccount::class, 'item_account_id', 'item_account_id');
    }

    // Relationship with ItemUnit
    public function itemUnit()
    {
        return $this->belongsTo(ItemUnit::class, 'item_unit_id', 'item_unit_id');
    }
}
