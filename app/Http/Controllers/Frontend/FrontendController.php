<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products = ProductType::where('hot', 1)->take(15)->get();
        $trending_category = Category::where('popular', 1)->take(15)->get();
        return view('frontend.index', compact('featured_products', 'trending_category'));
    }
    public function category()
    {
        $category = Category::where('status', '1')->paginate(4);
        return view('frontend.category', compact('category'));
    }
    public function viewcategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('cate_id', $category->id)->where('status', '1')->paginate(4);
        return view('frontend.products.index', compact('category', 'products'));
    }
    public function productview($cate_slug, $prod_slug)
    {
        Category::where('slug', $cate_slug)->firstOrFail();
        $products= Product::where('slug', $prod_slug)->firstOrFail();
        $ratings = Rating::where('prod_id', $products->id)->get();
        $rating_sum = Rating::where('prod_id', $products->id)->sum('stars_rated');
        $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();
        $reviews = Review::where('prod_id', $products->id)->get();
        if ($ratings->count() > 0) {
            $rating_value = $rating_sum / $ratings->count();
        } else {
            $rating_value = 0;
        }
        return view('frontend.products.view', compact('products', 'reviews', 'ratings', 'rating_value', 'user_rating'));
    }
    public function productlistAjax()
    {
        $products = Product::select('name')->where('status', '1')->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }
    public function search()
    {
        return view('frontend.search');
    }
    public function searchProduct(Request $request)
    {
        $search_product = $request->product_name;
        if ($search_product != '') {
            $products = Product::where('name', "LIKE", "%$search_product%")->get();
            if ($products) {
                return view('frontend.search', compact('products'));
            }
        } else {
            return redirect()->back();
        }
    }
    // public function searchResult(Request $request)
    // {
    //     $search_product=$request->product_name;
    //     if ($search_product!='') {
    //         $products=Product::where('name',"LIKE","%$search_product%")->first();
    //         if($products){
    //             return redirect('/category/'.$products->category->slug.'/'.$products->slug);
    //         }
    //         else{
    //             return redirect()->back()->with('status','No products matched your search');
    //         }
    //     } else {
    //         return redirect()->back();
    //     }

    // }
}
