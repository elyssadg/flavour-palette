<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderHeader;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($customerId, $sellerId): void
    {
        OrderHeader::create([
            'id' => Str::uuid(),
            'customer_id' => $customerId,
            'seller_id' => $sellerId[0],
            'order_date' => Carbon::now(),
            'total_price' => 1000000
        ]);
    }
}
