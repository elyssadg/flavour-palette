<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($userId)
    {
        $sellerId = Str::uuid()->toString();
        Seller::create([
            'id' => $sellerId,
            'user_id' => $userId[1],
            'name' => 'Vije Catering',
            'description' => 'Catering yummy top 1 Indonesia',
            'store_rating' => 5,
            'halal_certification' => '1686811274.png',
            'business_permit' => '1686811296.png',
            'address' => 'Selokan Sudirman',
            'opening_hour' => '10:00:00',
            'closing_hour' => '00:00:00'
        ]);

        return $sellerId;
    }
}
