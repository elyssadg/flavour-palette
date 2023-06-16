<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
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
}
