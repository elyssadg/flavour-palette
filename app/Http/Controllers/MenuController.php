<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class MenuController extends Controller
{
    // Top Menus from a Seller
    public function getTopMenusSeller() {
        $sellerId = Auth::user()->seller->id;
        $menus = Menu::where('status', 'available')
                        ->where('seller_id', $sellerId)
                        ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                        ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                        ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered')
                        ->orderByDesc('average_rating')
                        ->take(4)
                        ->get();
        
        return $menus;
    }

    // Home View
    public function home() {
        if (Auth::user() && Auth::user()->role == "seller") {
            $menus = $this->getTopMenusSeller();
            $categories = CategoryController::getAllCategory();
            return view('pages.home', compact('menus', 'categories'));
        } else {
            $menus = Menu::where('status', 'available')
                    ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                    ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                    ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered')
                    ->orderByDesc('average_rating')
                    ->take(4)
                    ->get();
            $sellers = SellerController::getTopSeller();
            return view('pages.home', compact('menus', 'sellers'));
        }
    }

    // Menu Detail View
    public function menuDetail($id) {

    }

    // Get Menu by Id
    public function getMenuById($id) {
        return Menu::find($id);
    }

    // Delete Menu
    public function deleteMenu($id) {
        $menu = Menu::find($id);
        $menu->delete();

        $menus = $this->getTopMenusSeller();
        $categories = CategoryController::getAllCategory();

        return redirect()->back()->with('menus', $menus)
                                ->with('categories', $categories);
    }
}
