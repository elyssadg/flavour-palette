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

        for ($j = 0; $j < 2; $j++){
            $tracker = 0;
            for ($k = 0; $k < 21; $k++) {
            $randomNumber = rand(0, 20);
                while (in_array($randomNumber, $randomNumbers)) {
                    $randomNumber = rand(0, 20);
                }

                $randomNumbers[$k] = $randomNumber;
            }
            for ($j = 0; $j < 7; $j++){
                for($l = 0; $l < 3; $l++){
                    if($tracker >= 21) break;
                    MenuWeekDetail::create([
                        'menu_id' => $menuId[$randomNumbers[$tracker]],
                        'available_date' => $dateStarts[$counter]
                    ]);
                    $tracker++;
                }
                $counter++;
            }
        }

    }
}
