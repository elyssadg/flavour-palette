<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $categoryId;

    public function run()
    {
        //
        $categoryId = [Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString()];

        Category::create([
            'id' => $categoryId[0],
            'name' => 'Protein'
        ]);
        Category::create([
            'id' => $categoryId[1],
            'name' => 'Fat'
        ]);
        Category::create([
            'id' => $categoryId[2],
            'name' => 'Dairy'
        ]);
        Category::create([
            'id' => $categoryId[3],
            'name' => 'Vegan'
        ]);
        Category::create([
            'id' => $categoryId[4],
            'name' => 'Spicy'
        ]);
        Category::create([
            'id' => $categoryId[5],
            'name' => 'Nut'
        ]);
        Category::create([
            'id' => $categoryId[6],
            'name' => 'Seafood'
        ]);
        Category::create([
            'id' => $categoryId[7],
            'name' => 'Halal'
        ]);
        Category::create([
            'id' => $categoryId[8],
            'name' => 'Fruit'
        ]);
        Category::create([
            'id' => $categoryId[9],
            'name' => 'Oils & Solid Fats'
        ]);
        return $categoryId;
    }
}
