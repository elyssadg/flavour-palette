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
        for ($i = 0; $i < (16) ; $i++) {
            $userId[] = Str::uuid()->toString();
        }

        $counter = 0;

        User::create([
            'id' => $userId[$counter++],
            'email' => 'guido@gmail.com',
            'phone_number' => '083831231231',
            'fullname' => 'Guido William',
            'password' => bcrypt('guido123'),
            'role' => 'customer',
            'status' => 'active'
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'vije@gmail.com',
            'phone_number' => '083831231231',
            'fullname' => 'vincetius J',
            'password' => bcrypt('vijeck123'),
            'role' => 'seller',
            'status' => 'active'
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'carolinee@gmail.com',
            'phone_number' => '085927182712',
            'fullname' => 'caroline irianto',
            'password' => bcrypt('caroline123'),
            'status' => 'active',
            'role' => 'seller'
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'erica.daniella@gmail.com',
            'phone_number' => '085828278271',
            'fullname' => 'erica daniella',
            'password' => bcrypt('ericaa890'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'Jane22@gmail.com',
            'phone_number' => '081583727262',
            'fullname' => 'Jane Smith',
            'password' => bcrypt('Smith456'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
                'email' => 'gicella17@gmail.com',
                'phone_number' => '081263527362',
                'fullname' => 'gicella mariska',
                'password' => bcrypt('gicel123'),
                'status' => 'active',
                'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'martha25@gmail.com',
            'phone_number' => '085927171919',
            'fullname' => 'gracia martha',
            'password' => bcrypt('marthaa01'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'devinharyadi@gmail.com',
            'phone_number' => '081372617382',
            'fullname' => 'devin haryadi',
            'password' => bcrypt('dehar1233'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'stevenwijayaa12@gmail.com',
            'phone_number' => '081283731912',
            'fullname' => 'steven wijaya',
            'password' => bcrypt('stevenuniv123'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'dewagung@gmail.com',
            'phone_number' => '085928281913',
            'fullname' => 'i dewa agung',
            'password' => bcrypt('dewaa321'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'juliacaroline27@gmail.com',
            'phone_number' => '085927118272',
            'fullname' => 'julia caroline',
            'password' => bcrypt('juliaa07'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'lavina12@gmail.com',
            'phone_number' => '081283739219',
            'fullname' => 'lavinatan',
            'password' => bcrypt('lavina12'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'sena.ong15@gmail.com',
            'phone_number' => '085917322186',
            'fullname' => 'sena ong',
            'password' => bcrypt('senaa03'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'dara.tiara17@gmail.com',
            'phone_number' => '081362728362',
            'fullname' => 'dara tiara',
            'password' => bcrypt('daraaa12'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'stephanienath@gmail.com',
            'phone_number' => '085962618363',
            'fullname' => 'stephanie nathania',
            'password' => bcrypt('stepnath23'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        User::create([
            'id' => $userId[$counter++],
            'email' => 'stevisumira@gmail.com',
            'phone_number' => '081283628917',
            'fullname' => 'stevi sumira',
            'password' => bcrypt('stevv28'),
            'status' => 'active',
            'role' => 'seller',
        ]);

        return $userId;
    }
}
