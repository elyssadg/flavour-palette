<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Menu;
use Carbon\Carbon;

class WishlistController extends Controller
{
    // Wishlist View
    public function wishlist() {
        $temp = Carbon::now()->addDays(7)->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d', $temp)->startOfWeek();
        $wishlist = Menu::join('wishlists', 'menus.id', '=', 'wishlists.menu_id')
                            ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                            ->where('customer_id', '=', Auth::user()->customer->id)
                            ->where('status', '=', 'available')
                            ->where('available_date', '>=', $date)
                            ->distinct('menus.id')
                            ->get();

        return view('pages.wishlist', compact('wishlist'));
    }

    // Add Wishlist
    public function addWishlist($id){
        $wishlist = new Wishlist();
        $wishlist->menu_id = $id;
        $wishlist->customer_id = Auth::user()->customer->id;
        $wishlist->save();
        
        return redirect()->back();
    }

    // Remove Wishlist
    public function removeWishlist($id) {
        $customerId = Auth::user()->customer->id;
        $wishlist = Wishlist::where('menu_id', '=', $id, 'and')
                            ->where('customer_id', '=', $customerId);
    
        if ($wishlist) {
            $wishlist->delete();
        }
    
        return redirect()->back();
    }

    // Update Wishlist
    public function updateWishlist(Request $request) {
        $customerId = $request->user_id;
        $menuId = $request->menu_id;
        $wishlist = Wishlist::where('menu_id', '=', $menuId, 'and')
                            ->where('customer_id', '=', $customerId);

        if ($wishlist->first()) {
            $wishlist->delete();
            return response()->json([
                'error' => 'false',
                'action' => 'remove'
            ]);
        } else {
            $wishlist = new Wishlist();
            $wishlist->menu_id = $menuId;
            $wishlist->customer_id = Auth::user()->customer->id;
            $wishlist->save();
            return response()->json([
                'error' => 'false',
                'action' => 'add'
            ]);
        }
    
        return response()->json([
            'error' => 'true'
        ]);
    }
}
