<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;
use PHPUnit\Framework\Constraint\Count;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if (Auth::check()) {
            $product=Product::select('id','name','selling_price','image','slug','qty')->where('id',$product_id)->first();
            if($product!=null){
                $oldcart=Session('Cart')?Session('Cart'):null;
                $newcart= new Cart($oldcart);
                if($newcart->products!=null){
                    if(array_key_exists($product_id,$newcart->products)){
                        $newcart->updateCart($product_id,$product_qty);
                        $request->session()->put('Cart',$newcart);
                        return response()->json(['status'=> "Update Cart successfully"]);
                    }
                } else {
                    $newcart->addCart($product_id,$product,$product_qty);
                    $request->session()->put('Cart',$newcart);
                    return response()->json(['status'=> "Add Cart successfully"]);
                }
                // return response()->json($newcart);
            }
        }
        else {
            return response()->json(['status'=> "Login to Continue"]);
        }
    }
    public function viewcart()
    {
        
        return view('frontend.cart');
    }
    public function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            $oldcart=Session('Cart')?Session('Cart'):null;
            $newcart= new Cart($oldcart);
            $newcart->deleteCart($prod_id);
            if(Count($newcart->products)>0){
                $request->Session()->put('Cart',$newcart);
                
            } else {
                $request->Session()->forget('Cart');
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
    public function updatecart(Request $request)
    {
        $product_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');
        if (Auth::check()) {
            $oldcart=Session('Cart')?Session('Cart'):null;
            $newcart= new Cart($oldcart);
            $newcart->updateCart($product_id,$product_qty);
            $request->Session()->put('Cart',$newcart);
            return response()->json($newcart);
        }
    }

    public function cartcount()
    {
        $cartcount =Session('Cart')?Count(Session('Cart')->products):0;
        return response()->json(['count' => $cartcount]);
    }
}
