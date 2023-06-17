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
    public function run($menuWeekHeaderId, $menuId)
    {
        $faker = Faker::create();

        $startDate = strtotime('2023-06-19');
        $dateStarts = [];

        for ($i = 0; $i < 3600; $i++) {
            $date = date('Y-m-d', strtotime('+' . $i . ' days', $startDate));
            $dateStarts[] = $date;
        }

        $randomNumbers = [];
        for ($k = 0; $k < 50; $k++) {
            $randomNumber = rand(0, 50);
            while (in_array($randomNumber, $randomNumbers)) {
                $randomNumber = rand(1, 50);
            }

            $randomNumbers[$k] = $randomNumber;
        }

        $j=0;
        $counter=0;
        for ($i = 0; $i < 1; $i++) {
            $tracker = 0;
            for ($j = 0; $j < 7; $j++){
                for($l = 0; $l < $faker->numberBetween(3, 6); $l++){
                    MenuWeekDetail::create([
                        'week_id' => $menuWeekHeaderId[$i],
                        'menu_id' => $menuId[$randomNumbers[$tracker++]],
                        'available_date' => $dateStarts[$counter]
                    ]);
                }
                $counter++;
            }
        }

    }
}
