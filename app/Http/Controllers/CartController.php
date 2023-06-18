<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;

class CartController extends Controller
{
    // Add to Cart
    public function addCart(Request $request){
        $date = DateTime::createFromFormat("l, d F Y", $request->available_date);
        $date = $date->format("Y-m-d");
        $user = Auth::user();
        $menu = Menu::find($request->menu_id);
        $item = Cart::where('customer_id', $user->customer->id)->where('menu_id',$menu->id)->where('available_date', $date)->first();
        if($item->count() == 0){
            $quantity = $request->quantity;
            Cart::insert([
                'id' => Str::uuid(),
                'customer_id' => $user->customer->id,
                'menu_id' => $menu->id,
                'available_date' => $date,
                'quantity' => $quantity
            ]);
        }else{
            $quantity = $item->quantity + $request->quantity;
            $item->quantity = $quantity;
            $item->save();
        }

        return redirect()->back();
    }
}
