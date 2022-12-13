<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','0')->paginate(1);
        return view('admin.orders.index', compact('orders'));
    }
    public function view($id)
    {
        $orders=Order::where('id',$id)->firstOrFail();
        $provinces = \Kjmtrue\VietnamZone\Models\Province::where('id',$orders->province_id)->first();
        $districts = \Kjmtrue\VietnamZone\Models\District::where('id',$orders->district_id)->first();
        $wards = \Kjmtrue\VietnamZone\Models\Ward::where('id',$orders->ward_id)->first();
        return view('admin.orders.view', compact('orders','provinces','districts','wards'));
    }
    public function updateorder(Request $request,$id)
    {
        $orders=Order::findOrFail($id);
        $orders->status=$request->input('order-status');
        $orders->update();
        return redirect('orders')->with('status','Order Update Successfully');
    }
    public function orderhistory()
    {
        $orders=Order::where('status','1')->orWhere('status', '3')->paginate(1);
        return view('admin.orders.history', compact('orders'));
    }
    public function search()
    {
        return view('admin.orders.search');
    }
    public function ordersearch(Request $request)
    {
        $order_search=$request->order_search;
        if ($order_search!='') {
            $orders=Order::where('created_at',"LIKE","%$order_search%")
            ->orWhere('tracking_no',"LIKE","%$order_search%")
            ->orWhere('total_price',"LIKE","%$order_search%")->paginate(1);
            if($orders){
                return view('admin.orders.search',compact('orders'));
            }
        } else {
            return redirect()->back();
        }
    }
}
