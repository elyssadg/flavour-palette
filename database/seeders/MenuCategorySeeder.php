<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($menuId, $categoryId): void
    {
        $usedCombinations = [];

        for ($i = 0; $i < 50; $i++) {
            do {
                $menuIdIndex = mt_rand(0, 50);
                $categoryIdIndex = mt_rand(0, 9);

                $combination = $menuId[$menuIdIndex] . '-' . $categoryId[$categoryIdIndex];
            } while (in_array($combination, $usedCombinations));

            $usedCombinations[] = $combination;

            MenuCategory::create([
                'menu_id' => $menuId[$menuIdIndex],
                'category_id' => $categoryId[$categoryIdIndex]
            ]);
        }
    }
}
