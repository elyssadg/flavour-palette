<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // Home View
    public function home() {
        $menus = Menu::where('status', 'available')
                    ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                    ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                    ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered')
                    ->orderByDesc('average_rating')
                    ->take(4)
                    ->get();

        $sc = new SellerController();
        $sellers = $sc->getTopSeller();

        return view('pages.home', compact('menus', 'sellers'));
    }
}
