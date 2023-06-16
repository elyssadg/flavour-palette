<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userId = [Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString()];
        
        User::create([
            'id' => $userId[0],
            'email' => 'guido@gmail.com',
            'phone_number' => '083831231231',
            'fullname' => 'Guido William',
            'password' => bcrypt('guido123'),
            'role' => 'customer',
            'status' => 'active'
        ]);

        User::create([
            'id' => $userId[1],
            'email' => 'vije@gmail.com',
            'phone_number' => '083831231231',
            'fullname' => 'vincetius J',
            'password' => bcrypt('vijeck123'),
            'role' => 'seller',
            'status' => 'active'
        ]);

        return $userId;
    }
}
