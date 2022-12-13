<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kjmtrue\VietnamZone\Models\Province ;
use Kjmtrue\VietnamZone\Models\District ;
use Kjmtrue\VietnamZone\Models\Ward ;
class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Session('Cart')?Session('Cart'):null;
        $newcart= new Cart($old_cartitems);
        foreach ($newcart->products as $item) {
            if (!Product::where('id', $item["productinfo"]->id)->where('qty', '>=', $item["productinfo"]->qty)->exists()) {
                $newcart->deleteCart($item["productinfo"]->id);
            }
        }
        $provinces = Province::get();
        $districts = District::whereProvinceId(Auth::user()->province_id)->get();
        $wards = Ward::whereDistrictId(Auth::user()->district_id)->get();
        $cartitems = $newcart;
        return view('frontend.checkout', compact('cartitems', 'provinces','districts','wards'));
    }
    public function placeorder(Request $request)
    {
        $total = 0;
        $old_cartitems = Session('Cart')?Session('Cart'):null;
        $newcart= new Cart($old_cartitems);
        foreach ($newcart->products as $item) {
            if (!Product::where('id', $item["productinfo"]->id)->where('qty', '>=', $item["productinfo"]->qty)->exists()) {
                $newcart->deleteCart($item["productinfo"]->id);
            }
        }
        $request->validate([
            'fname' => 'required|alpha|max:20|min:2',
            'lname' => 'required|alpha|max:20|min:2',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:40|min:5',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',

        ]);
        foreach ($newcart->products as $item) {
            $total+=$item["qty"]*$item["productinfo"]->selling_price;
        }
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = Auth::user()->email;
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->province_id = $request->input('province');
        $order->district_id = $request->input('district');
        $order->ward_id = $request->input('ward');
        $order->tracking_no = 'ecom' . rand(1000, 9999);
        $order->total_price = $total;
        $order->save();

        foreach ($newcart->products as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item["productinfo"]->id,
                'qty' => $item["qty"],
                'price' => $item["productinfo"]->selling_price,
            ]);
            $prod = Product::where('id', $item["productinfo"]->id)->first();
            $prod->qty = $prod->qty - $item["qty"];
            $prod->update();
        }
        if (Auth::user()->address !== $request->input('address')
        ||Auth::user()->fname!==$request->input('fname')
        ||Auth::user()->lname!==$request->input('lname')
        ||Auth::user()->phone!==$request->input('phone')
        ||Auth::user()->province_id!==$request->input('province')
        ||Auth::user()->district_id!==$request->input('district')
        ||Auth::user()->ward_id!==$request->input('ward')) {
            $user = User::where('id', Auth::id())->first();
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->province_id = $request->input('province');
            $user->district_id = $request->input('district');
            $user->ward_id = $request->input('ward');
            $user->update();
        }
        $request->Session()->forget('Cart');
        return redirect('/my-orders')->with('status', 'Place Order Successfully');
    }
    public function getdistrict($id)
    {
        $districts = District::whereProvinceId($id)->get();
        return response()->json(['districts' => $districts]);
    }
    public function getward($id)
    {
        $wards = Ward::whereDistrictId($id)->get();
        return response()->json(['wards' => $wards]);
    }
}
