<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $products=Product::where('slug',$product_slug)->where('status','0')->first();
        if($products){
            $product_id=$products->id;
            $review=Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
            if ($review) {
                return view('frontend.reviews.edit',compact('review'));
            } else {
                $verified_purchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $product_id)->get();
            return view('frontend.reviews.index',compact('products','verified_purchase'));
            }
            
            
        }else {
            return redirect()->back()->with('status','The link you folowed was broken');
        }
    }
    public function create(Request $request)
    {
        $product_id=$request->input('product_id');
        $products=Product::where('id',$product_id)->where('status','0')->first();
        if($products){
            $user_review=$request->input('user_review');
            $new_review=Review::create([
                'user_id'=>Auth::id(),
                'prod_id'=>$product_id,
                'user_review'=>$user_review,
            ]);
            if($new_review){
                return redirect('/category/'.$products->category->slug.'/'.$products->slug)->with('status','Thank for write a review');
            }
        }
        else{
            return redirect()->back()->with('status','The link you folowed was broken');
        }
    }
    public function edit($product_slug)
    {
        $products=Product::where('slug',$product_slug)->where('status','0')->first();
        if($products){
            $product_id=$products->id;
            $review=Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
            return view('frontend.reviews.edit',compact('review'));
        }else {
            return redirect()->back()->with('status','The link you folowed was broken');
        }
    }
    public function update(Request $request)
    {
        $user_review=$request->input('user_review');
        if ($user_review !='') {
            $review_id=$request->input('review_id');
            $review=Review::where('id',$review_id)->where('user_id',Auth::id())->first();
                if($review){
                    $review->user_review=$user_review;
                $review->update();
                return redirect('/category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status','Review updated successfully');
            }
            else{
                return redirect()->back()->with('status','The link you folowed was broken');
            }
        } else {
            return redirect()->back()->with('status','You can not submit an empty review');
        }
        
    }
}
