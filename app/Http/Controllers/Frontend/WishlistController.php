<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist=Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist'));
    }
    public function add(Request $request)   
    {
        if (Auth::check()) {
            $prod_id= $request->input('product_id');
            if(Product::find($prod_id)){
                $wishlist= new Wishlist();
                $wishlist->prod_id=$prod_id;
                $wishlist->user_id=Auth::id();
                $wishlist->save();
                return response()->json(['status'=> 'Product added to wishlist']);
            } else{
                return response()->json(['status'=> 'Product doesnot exist']);
            }
        } else {
            return response()->json(['status'=> "Login to Continue"]);
        }

    }
    public function delete(Request $request)
    {
        if(Auth::check()){
            $prod_id= $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cartitem=Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartitem->delete();
                return response()->json(['status'=> "Wishlist Item Deleted Successfuly"]);
            } 
        }else {
            return response()->json(['status'=> "Login to Continue"]);
        }
    }
    public function wishlistcount()
    {
        $wishlistcount=Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishlistcount]);
    }
}
