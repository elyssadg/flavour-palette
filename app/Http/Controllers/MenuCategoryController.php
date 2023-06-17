<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    // Add Menu Category
    public static function addCategory($menuId, $categoryId) {
        $mc = new MenuCategory();
        $mc->menu_id = $menuId;
        $mc->category_id = $categoryId;
        $mc->save();
    }

    // Delete Menu Category
    public static function deleteCategory($menuId) {
        MenuCategory::where('menu_id', $menuId)
                    ->delete();
    }
}
