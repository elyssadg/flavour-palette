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

        MenuCategory::create([
            'menu_id' => $menuId[0],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[0],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[1],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[2],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[2],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[3],
            'category_id' => $categoryId[3]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[3],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[3],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[4],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[4],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[4],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[5],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[5],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[5],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[6],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[6],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[6],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[7],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[7],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[7],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[8],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[8],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[9],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[9],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[10],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[10],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[10],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[10],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[11],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[11],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[11],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[12],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[12],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[13],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[13],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[13],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[13],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[13],
            'category_id' => $categoryId[7]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[14],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[14],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[14],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[15],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[15],
            'category_id' => $categoryId[6]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[16],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[16],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[16],
            'category_id' => $categoryId[2]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[16],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[17],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[17],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[17],
            'category_id' => $categoryId[6]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[18],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[18],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[18],
            'category_id' => $categoryId[4]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[18],
            'category_id' => $categoryId[5]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[19],
            'category_id' => $categoryId[0]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[19],
            'category_id' => $categoryId[1]
        ]);
        MenuCategory::create([
            'menu_id' => $menuId[19],
            'category_id' => $categoryId[5]
        ]);
    }
}
