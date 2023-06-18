<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\Cart;
use Carbon\Carbon;

class OrderHeaderController extends Controller
{
    // Order History View
    public function orders(Request $request) {
        $user = Auth::user();
        $orderHeader = OrderHeader::select('order_headers.*')
                                    ->where('order_headers.customer_id', $user->customer->id)
                                    ->get();

        return view('pages.order_history', compact('orderHeader'));
    }

    // Pay
    public function createOrder(Request $request) {
        $orderHeaderId = Str::uuid();
        OrderHeader::insert([
            'id' => $orderHeaderId,
            'customer_id' => Auth::user()->customer->id,
            'order_date' => Carbon::now(),
            'total_price' => $request->total_price,
            'destination' => $request->address
        ]);

        $cc = new CartController();
        $carts = $cc->getCart();
        foreach ($carts as $cart){
            OrderDetail::insert([
                'order_id' => $orderHeaderId,
                'menu_id' => $cart->menu->id,
                'arrival_date'=> $cart->available_date,
                'quantity' => $cart->quantity,
                'status' => 'Waiting'
            ]);
        }

        Cart::where('customer_id', Auth::user()->customer->id)->delete();

        return redirect('/');
    }
}
