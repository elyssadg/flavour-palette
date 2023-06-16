<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Get All Category
    public static function getAllCategory() {
        return Category::all();
    }
}
