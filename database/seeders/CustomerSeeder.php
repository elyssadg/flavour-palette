<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($userId)
    {
        $customerId = Str::uuid();
        Customer::create([
            'id' => $customerId,
            'user_id' => $userId[0],
            'username' => 'guido',
            'gender' => 'male',
            'dob' => Carbon::parse('2003-11-11')
        ]);

        return $customerId;
    }
}
