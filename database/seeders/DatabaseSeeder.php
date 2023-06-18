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
        // User
        $userSeeder = new UserSeeder();
        $userId = $userSeeder->run();

        // Seller
        $cateringSeeder = new SellerSeeder();
        $cateringId = $cateringSeeder->run($userId);

        // Customer
        $customerSeeder = new CustomerSeeder();
        $customerId = $customerSeeder->run($userId);

        // Menu
        $menuSeeder = new MenuSeeder();
        $menuId = $menuSeeder->run($cateringId);

        // Review
        $reviewSeeder = new MenuReviewSeeder();
        $reviewSeeder->run($menuId, $customerId);

        // Category
        $categorySeeder = new CategorySeeder();
        $categoryId = $categorySeeder->run();

        // MenuCategory
        $menuCategorySeeder = new MenuCategorySeeder();
        $menuCategorySeeder->run($menuId, $categoryId);

        // OrderHeader
        $orderHeaderSeeder = new OrderHeaderSeeder();
        $orderHeaderSeeder->run($customerId, $cateringId);

        // MenuWeekDetail
        $menuWeekDetailSeeder = new MenuWeekDetailSeeder();
        $menuWeekDetailSeeder->run($menuId);
    }
}
