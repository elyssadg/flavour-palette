<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($menuId, $customerId): void
    {
        Wishlist::create([
            'menu_id' => $menuId[0],
            'customer_id' => $customerId[0]
        ]);
    }
}
