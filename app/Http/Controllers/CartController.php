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
    // Get User Cart
    public function getCart() {
        $user = Auth::user();
        $carts = Cart::join('menus', 'menus.id', '=', 'carts.menu_id')
                        ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->join('customers', 'customers.id', '=', 'carts.customer_id')
                        ->where('customers.id', '=', $user->customer->id)
                        ->where('menus.status', '=', 'available')
                        ->whereColumn('menu_week_details.available_date', 'carts.available_date')
                        ->select('carts.*')
                        ->get();
        return $carts;
    }

    // Show Cart
    public function cart() {
        $carts = $this->getCart();
        return view('pages.cart', compact('carts'));
    }
        
    // Add to Cart
    public function addCart(Request $request){
        $date = DateTime::createFromFormat("l, d F Y", $request->available_date);
        if (!$date) $date = DateTime::createFromFormat("Y-m-d", $request->available_date);
        $date = $date->format("Y-m-d");
        $user = Auth::user();
        $menu = Menu::find($request->menu_id);
        $item = Cart::where('customer_id', $user->customer->id)->where('menu_id',$menu->id)->where('available_date', $date)->first();
        if($item == null){
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

    // Edit Cart
    public function updateQuantity(Request $request){
        $cart = Cart::find($request->cart_id);
        if ($request->action == "increase"){
            $cart->quantity += 1;
            $cart->save();
        } else if ($request->action == "decrease"){
            if ($cart->quantity > 1){
                $cart->quantity -= 1;
                $cart->save();
            }
        } else if ($request->action == "delete"){
            Cart::where('id', '=', $cart->id)->delete();
        }

        $carts = $this->getCart();
        return view('pages.cart', compact('carts'));
    }
}
