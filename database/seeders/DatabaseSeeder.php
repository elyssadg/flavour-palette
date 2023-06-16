<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userSeeder = new UserSeeder();
        $userId = $userSeeder->run();
        $cateringSeeder = new SellerSeeder();
        $cateringId = $cateringSeeder->run($userId);
        $customerSeeder = new CustomerSeeder();
        $customerId = $customerSeeder->run($userId);
        $menuSeeder = new MenuSeeder();
        $menuId = $menuSeeder->run($cateringId);
        $reviewSeeder = new MenuReviewSeeder();
        $reviewSeeder->run($menuId, $customerId);
        $categorySeeder = new CategorySeeder();
        $categoryId = $categorySeeder->run();
        $menuCategorySeeder = new MenuCategorySeeder();
        $menuCategorySeeder->run($menuId, $categoryId);
        $orderHeaderSeeder = new OrderHeaderSeeder();
        $orderHeaderSeeder->run($customerId, $cateringId);
    }
}
