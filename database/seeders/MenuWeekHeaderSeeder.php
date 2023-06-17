<?php

namespace Database\Seeders;

use App\Models\MenuWeekHeader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuWeekHeaderSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // for ($i = 0; $i < (1) ; $i++) {
        //     $menuWeekId[] = Str::uuid()->toString();
        // }

        // $faker = Faker::create();

        // $startDate = '2023-06-19';
        // $endDate = '2023-06-25';
        // $dateDuration = [
        //     [
        //         'start' => $startDate,
        //         'end' => $endDate
        //     ],
        // ];

        // for ($i = 0; $i < 1; $i++) {
        //     $randomStartDate = date('Y-m-d', strtotime('+1 days', strtotime($dateDuration[$i]['end'])));
        //     $randomEndDate = date('Y-m-d', strtotime('+7 days', strtotime($dateDuration[$i]['end'])));

        //     $dateDuration[] = [
        //         'start' => $randomStartDate,
        //         'end' => $randomEndDate
        //     ];
        // }

        // for ($i = 0; $i < 1; $i++) {
        //     MenuWeekHeader::create([
        //         'id' => $menuWeekId[$i],
        //         'start_date' => $dateDuration[$i]['start'],
        //         'end_date' => $dateDuration[$i]['end']
        //     ]);
        // }

        // return $menuWeekId;

    }
}
