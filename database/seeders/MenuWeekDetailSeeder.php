<?php

namespace Database\Seeders;

use App\Models\MenuWeekDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MenuWeekDetailSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run($menuId)
    {
        $faker = Faker::create();

        $startDate = strtotime('2023-06-19');
        $dateStarts = [];

        for ($i = 0; $i < 14; $i++) {
            $date = date('Y-m-d', strtotime('+' . $i . ' days', $startDate));
            $dateStarts[] = $date;
        }

        $randomNumbers = [];

        $counter=0;
        for ($k = 0; $k < 20; $k++) {
            $randomNumber = rand(0, 19);
            while (in_array($randomNumber, $randomNumbers)) {
                $randomNumber = rand(0, 19);
            }

            $randomNumbers[$k] = $randomNumber;
        }

        for ($j = 0; $j < 14; $j++){
            $tracker = 0;
            for($l = 0; $l < $faker->numberBetween(1,4); $l++){
                MenuWeekDetail::create([
                    'menu_id' => $menuId[$randomNumbers[$tracker++]],
                    'available_date' => $dateStarts[$counter]
                ]);
            }
            $counter++;
        }

    }
}
