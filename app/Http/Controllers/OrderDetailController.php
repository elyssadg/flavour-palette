<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    // Order Detail View
    public function orderDetail(Request $request, $id) {
        $orderHeader = OrderHeader::find($id);

        if ($request->input('accept')) {
            $orderHeader->order_detail()->where('arrival_date', $request->input('accept'))->update(['status' => 'In Progress']);
        } else if($request->input('update_status')){
            $orderHeader->order_detail()->where('arrival_date', $request->input('update_status'))->update(['status' => 'In Delivery']);
        } else if($request->input('finish')){
            $orderHeader->order_detail()->where('arrival_date', $request->input('finish'))->update(['status' => 'Done']);
        }

        return view('pages.order_detail', compact('orderHeader'));
    }

    // Get All Order for a Seller
    public static function getOrderBySeller($seller_id) {
        $orders = OrderDetail::where('seller_id', $seller_id)
                                ->get();
        return $orders;
    }
}
