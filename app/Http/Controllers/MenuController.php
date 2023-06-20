<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\MenuWeekDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    // Top Menus from a Seller
    public function getTopMenusSeller($date) {
        $sellerId = Auth::user()->seller->id;
        $menus = Menu::where('status', 'available')
                        ->where('seller_id', $sellerId)
                        ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                        ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('available_date', '>=', $date)
                        ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'menus.description', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                        ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'menus.description')
                        ->orderByDesc('average_rating')
                        ->take(4)
                        ->get();
        
        return $menus;
    }

    // Sorting
    private function sorting($sortBy, $menus, $selectedDate){
        if($sortBy){
            switch($sortBy){
                case "highest_rating":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(menu_reviews.rating) / COUNT(menu_reviews.rating))'))
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selectedDate)
                                    ->groupBy('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('(SUM(menu_reviews.rating) / COUNT(menu_reviews.rating)) DESC')
                                    ->get();
                    break;
                }
                case "lowest_price":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selectedDate)
                                    ->groupBy('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('menus.price ASC')
                                    ->get();
                    break;
                }
                case "highest_price":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selectedDate)
                                    ->groupBy('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('menus.price DESC')
                                    ->get();
                    break;
                }
            }
        }

        return $menus;
    }

    private function filter($request, $menus, $categories, $selectedDate){
        if($request->input('filter')){
            $lowestPrice = 0;
            if($request->lowest_price) $lowestPrice = $request->lowest_price;

            $highestPrice = 50000000000;
            if($request->highest_price) $highestPrice = $request->highest_price;

            $rating = 0;
            if($request->rating) $rating = $request->rating;

            $selectedCategories = $request->categories;
            if ($selectedCategories == null) $selectedCategories = array_map(function($category) { return $category['name']; }, $categories->toArray());
            
            $menus = Menu::select('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(menu_reviews.rating) / COUNT(menu_reviews.rating))'))
                        ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                        ->join('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                        ->join('menu_categories', 'menus.id', '=', 'menu_categories.menu_id')
                        ->join('categories', 'categories.id', '=', 'menu_categories.category_id')
                        ->where('status', 'available')
                        ->where('available_date', $selectedDate)
                        ->whereBetween('menus.price', [$lowestPrice, $highestPrice])
                        ->whereIn('categories.name', $selectedCategories)
                        ->groupBy('menus.id','menus.profile_menu','menus.seller_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                        ->havingRaw('(SUM(menu_reviews.rating) / COUNT(menu_reviews.rating)) >= ?', [$rating])
                        ->orderByRaw('(SUM(menu_reviews.rating) / COUNT(menu_reviews.rating)) DESC')
                        ->get();
        }

        return $menus;
    }

    // Home View
    public function home() {
        $temp = Carbon::now()->addDays(7)->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d', $temp)->startOfWeek();
        if (Auth::user() && Auth::user()->role == "seller") {
            $menus = $this->getTopMenusSeller($date);
            $categories = CategoryController::getAllCategory();
            $orders = OrderDetailController::getOrderBySeller(Auth::user()->seller->id);
            return view('pages.home', compact('menus', 'categories', 'orders'));
        } else {
            $menus = Menu::where('status', 'available')
                                ->leftJoin('menu_reviews', 'menus.id', '=', 'menu_reviews.menu_id')
                                ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                                ->where('available_date', '>=', $date)
                                ->select('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'available_date', DB::raw('AVG(menu_reviews.rating) as average_rating'))
                                ->groupBy('menus.id', 'menus.name', 'menus.profile_menu', 'menus.seller_id', 'menus.price', 'menus.ordered', 'available_date')
                                ->orderByDesc('average_rating')
                                ->take(4)
                                ->get();
            $sellers = SellerController::getTopSeller();
            return view('pages.home', compact('menus', 'sellers'));
        }
    }

    // Menu View
    public function menu(Request $request) {
        // Menu Category
        $categories = CategoryController::getAllCategory();

        // Set Up Date Filter
        $selectedDate = $request->input('date_btn');
        $currentDate = Carbon::now()->addDays(7)->format('Y-m-d');
        $startDate = Carbon::createFromFormat('Y-m-d', $currentDate)->startOfWeek();
        if ($selectedDate == null) $selectedDate = $startDate;

        $dates = [];
        $tempDate = $startDate->copy();
        while ($tempDate <= $startDate->copy()->endOfWeek()) {
            $dates[] = $tempDate->copy();
            $tempDate->addDay();
        }

        if (Auth::user() && Auth::user()->role == "seller") {
            $changeDate = $request->input('start_date');
            if ($changeDate) {
                $startDate = Carbon::createFromFormat('Y-m-d', $changeDate)->startOfWeek();
                $selectedDate = $startDate;

                $dates = [];
                $tempDate = $startDate->copy();
                while ($tempDate <= $startDate->copy()->endOfWeek()) {
                    $dates[] = $tempDate->copy();
                    $tempDate->addDay();
                }
            }

            $availableMenus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                                        ->where('status', 'available')
                                        ->where('available_date', $selectedDate)
                                        ->where('seller_id', Auth::user()->seller->id)
                                        ->select('menus.*', 'available_date')
                                        ->get();
            $availableMenus = $this->sorting($request->sort_by, $availableMenus, $selectedDate);
            $availableMenus = $this->filter($request, $availableMenus, $categories, $selectedDate);

            $archivedMenus = Menu::where('status', 'archived')
                                    ->where('seller_id', Auth::user()->seller->id)
                                    ->select('menus.*')
                                    ->get();

            return view('pages.menu', compact('availableMenus', 'archivedMenus', 'dates', 'selectedDate', 'categories'));
        } else {
            $menus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('status', 'available')
                        ->where('available_date', $selectedDate)
                        ->select('menus.*', 'available_date')
                        ->paginate(10);

            $menus = $this->sorting($request->sort_by, $menus, $selectedDate);
            $menus = $this->filter($request, $menus, $categories, $selectedDate);

            return view('pages.menu', compact('menus', 'dates', 'selectedDate', 'categories'));
        }
    }

    // Menu Detail View
    public function menuDetail(Request $request, $id) {
        $date = $request->input('date_btn');
        $menu = Menu::find($id);

        if ($date == null) {
            $temp = Carbon::now()->addDays(7)->format('Y-m-d');
            $date = Carbon::createFromFormat('Y-m-d', $temp)->startOfWeek();
        } else {
            $date = date('Y-m-d', strtotime($date));
        }

        $menu = Menu::select('menus.*', 'available_date')
                        ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('menus.id', '=', $id)
                        ->where('status', '=', 'available')
                        ->where('available_date', '>=', $date)
                        ->first();
        $menu->available_date = Carbon::parse($menu->available_date)->format('l, d F Y');

        return view('pages.menu_detail', compact('menu'));
    }

    // Search Menu
    public function search(Request $request){
        // Menu Category
        $categories = CategoryController::getAllCategory();

        // Set Up Date Filter
        $selectedDate = $request->input('date_btn');
        $currentDate = Carbon::now()->addDays(7)->format('Y-m-d');
        $startDate = Carbon::createFromFormat('Y-m-d', $currentDate)->startOfWeek();
        if ($selectedDate == null) $selectedDate = $startDate;
        $dates = [];
        $tempDate = $startDate->copy();
        while ($tempDate <= $startDate->copy()->endOfWeek()) {
            $dates[] = $tempDate->copy();
            $tempDate->addDay();
        }

        $menus = Menu::where('name','LIKE',"%$request->search%")
                        ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('available_date', $selectedDate)
                        ->get();

        return view('pages.menu', compact('categories','dates','menus', 'selectedDate'));
    }

    // Get Menu by Id
    public function getMenuById($id) {
        return Menu::find($id);
    }

    // Add Menu
    public function addMenu(Request $request) {
        $validation = [
            'menu_image' => 'required|mimetypes:image/jpeg,image/jpg,image/png',
            'menu_name' => 'required|min:5',
            'menu_price' => 'required|numeric|min:0',
            'menu_description' => 'required|min:10',
            'categories' => 'required',
            'menu_date' => 'required|after:today'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            $error_message = $validator->errors()->first();
            return response()->json([
                'error' => true,
                'error_message' => $error_message
            ]);
        }

        $menu = new Menu();
        $menu->id = Str::uuid();
        $menu->seller_id = Auth::user()->seller->id;
        $menu->name = $request->menu_name;
        $menu->price = $request->menu_price;
        $menu->status = 'available';
        $menu->description = $request->menu_description;
        if($request->menu_image != null){
            $file = $request->file('menu_image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/profile/menu', $file, $imageName);
            $menu->profile_menu = $imageName;
        }
        $menu->save();

        $categories = $request->input('categories');
        foreach ($categories as $c) {
            MenuCategoryController::addCategory($menu->id, $c);
        }

        MenuWeekDetail::create([
            'menu_id' => $menu->id,
            'available_date' => $request->menu_date
        ]);

        return response()->json([
            'error' => false,
            'redirect' => '/'
        ]);
    }

    // Archive Menu
    public function deleteMenu($id) {
        $menu = Menu::find($id);
        $menu->status = 'archived';
        $menu->save();

        $temp = Carbon::now()->addDays(7)->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d', $temp)->startOfWeek();
        $menus = $this->getTopMenusSeller($date);
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
            'menu_description' => 'required|min:10',
            'menu_date' => 'required|after:today'
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
