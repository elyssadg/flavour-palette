<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use App\Models\Menu;
use Carbon\Carbon;

class MenuController extends Controller
{
    // Top Menus from a Seller
    public function getTopMenusSeller() {
        $sellerId = Auth::user()->seller->id;
        $menus = Menu::where('status', 'available')
                        ->where('seller_id', $sellerId)
                        ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                        ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'menus.description', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                        ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'menus.description')
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

    // Menu View
    public function menu(Request $request) {
        if (Auth::user() && Auth::user()->role == "seller") {
            
        } else {
            // Menu Category
            $categories = CategoryController::getAllCategory();

            // Set Up Date Filter
            $selectedDate = $request->input('date_btn');
            $currentDate = Carbon::now()->addDays(7)->format('Y-m-d');
            if ($selectedDate == null) $selectedDate = $currentDate;
            $menus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('status', 'available')
                        ->where('available_date', $selectedDate)
                        ->select('menus.*')
                        ->paginate(10);
            
            $dates = [];
            $startDate = Carbon::createFromFormat('Y-m-d', $currentDate)->startOfWeek();
            $temp_date = $startDate->copy();
            while ($temp_date <= $startDate->copy()->endOfWeek()) {
                $dates[] = $temp_date->copy();
                $temp_date->addDay();
            }

            return view('pages.menu', compact('menus', 'dates', 'selectedDate', 'categories'));
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

    // Update Menu
    public function editMenu(Request $request) {
        $validation = [
            'menu_image' => 'mimetypes:image/jpeg,image/jpg,image/png',
            'menu_name' => 'required|min:5',
            'menu_price' => 'required|numeric|min:0',
            'menu_description' => 'required|min:10'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            $error_message = $validator->errors()->first();
            return response()->json([
                'error' => true,
                'error_message' => $error_message
            ]);
        }

        $menu = Menu::find($request->menu_id);
        $menu->name = $request->menu_name;
        $menu->price = $request->menu_price;
        $menu->description = $request->menu_description;
        if($request->menu_image != null){
            $file = $request->file('menu_image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/profile/menu', $file, $imageName);
            $menu->profile_menu = $imageName;
        }

        $categories = $request->input('categories');
        MenuCategoryController::deleteCategory($menu->id);
        foreach ($categories as $c) {
            MenuCategoryController::addCategory($menu->id, $c);
        }

        return response()->json([
            'error' => false,
            'redirect' => '/'
        ]);
    }
}
