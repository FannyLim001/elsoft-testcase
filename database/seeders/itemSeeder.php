<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Items::create([
            'item_group' => 'Produk Lain-Lain',
        ]);
    }
}
