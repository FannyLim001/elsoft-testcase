<?php

namespace Database\Seeders;

use App\Models\ItemAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class itemAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemAccount::create([
            'item_account_group' => 'Default',
        ]);
    }
}
