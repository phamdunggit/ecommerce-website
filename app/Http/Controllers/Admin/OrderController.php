<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function index()
    {
        $status='';
        $orders=Order::orderby('created_at', 'asc')->paginate(1);
        return view('admin.orders.index', compact('orders','status'));
    }
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $status = $request->get('status');
            if($status!="Status"){
                $orders = Order::where(function ($query)use ($search) {
                    $query->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search."%")->orWhere('tracking_no',"LIKE","%$search%")
                ->orWhere('total_price',"LIKE","%$search%");
                })->where(function ($query)use ($status) {
                    $query->where('status',$status);
                })
                ->orderBy($sort_by, $sort_type)
                ->paginate(1);
            } else {
                $status='';
                $orders = Order::where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search."%")->orWhere('tracking_no',"LIKE","%$search%")->orWhere('tracking_no',"LIKE","%$search%")
                ->orWhere('total_price',"LIKE","%$search%")->orderBy($sort_by, $sort_type)
                ->paginate(1);
            }
            
            return view('admin.orders.data', compact('orders','status'))->render();
        }
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
    public function search()
    {
        return view('admin.orders.search');
    }
    public function ordersearch(Request $request)
    {
        $status='';
        $search=$request->order_search;
        if ($search!='') {
            $orders=Order::where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$search."%")
            ->orWhere('created_at',"LIKE","%$search%")
            ->orWhere('tracking_no',"LIKE","%$search%")
            ->orWhere('total_price',"LIKE","%$search%")->paginate(1);
            if($orders){
                return view('admin.orders.search',compact('orders','status','search'));
            }
        } else {
            return redirect()->back();
        }
    }
}
