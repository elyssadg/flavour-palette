<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use App\Models\Seller;

class OrderDetailController extends Controller
{
    // Order Detail View
    public function orderDetail(Request $request, $id) {
        $orderHeader = OrderHeader::find($id);
        return view('pages.order_detail', compact('orderHeader'));
    }

    // Change Status
    public function changeStatus(Request $request) {
        $od = OrderDetail::where('menu_id', $request->menu_id)->where('order_id', $request->order_id)->where('arrival_date', $request->date);
        if ($request->accept) {
            $od->update(['status' => 'In Progress']);
        } else if($request->update_status){
            $od->update(['status' => 'In Delivery']);
        } else if($request->finish){
            $od->update(['status' => 'Done']);
            $od = $od->first();
            $seller = Seller::find($od->seller_id);
            $seller->pocket += $od->quantity * $od->menu->price;
            $seller->save();
        }

        return redirect()->back();
    } 

    // Get All Order for a Seller
    public static function getOrderBySeller($seller_id) {
        $orders = OrderDetail::where('seller_id', $seller_id)
                                ->get();
        return $orders;
    }
}
