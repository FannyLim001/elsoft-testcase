<?php

namespace Database\Seeders;

use App\Models\ItemUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class itemUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemUnit::create([
            'item_unit' => 'PCS',
        ]);
    }
}
