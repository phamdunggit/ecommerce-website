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
use Illuminate\Support\Facades\DB;

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
        // $products = Product::select("*")->where('cate_id', $category->id)->where('status', '1')->orderby("created_at","desc")->paginate(4);
        $products = Product::select("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at", DB::raw("COUNT(order_items.prod_id) as sold"))
            ->leftJoin("order_items", "products.id", "=", "order_items.prod_id")
            ->leftJoin("orders", "order_items.order_id", "=", "orders.id")
            ->where('products.cate_id', $category->id)
            ->where('products.status', '1')
            ->orderBy("products.created_at", "desc")
            ->groupBy("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at")
            ->paginate(4);
        return view('frontend.products.index', compact('category', 'products'));
        // dd($products);
    }
    public function fetchdata(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $cate=$request->get('category');
            if($cate!=""){
                $category = Category::where('slug',$cate)->first();
                $cate_id=$category->id;
                $products = Product::select("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at", DB::raw("COUNT(order_items.prod_id) as sold"))
                ->leftJoin("order_items", "products.id", "=", "order_items.prod_id")
                ->leftJoin("orders", "order_items.order_id", "=", "orders.id")
                ->where('products.name', "LIKE", "%$search%")
                ->where('products.cate_id', $cate_id)
                ->where('products.status', '1')
                ->orderBy($sort_by, $sort_type)
                ->groupBy("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at")
                ->paginate(4);
            return view('frontend.products.data', compact('products','category'))->render();
            } else {
                $products = Product::select("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at", DB::raw("COUNT(order_items.prod_id) as sold"))
                ->leftJoin("order_items", "products.id", "=", "order_items.prod_id")
                ->leftJoin("orders", "order_items.order_id", "=", "orders.id")
                ->where('products.name', "LIKE", "%$search%")
                ->where('name', "LIKE", "%$search%")
                ->where('products.status', '1')
                ->orderBy($sort_by, $sort_type)
                ->groupBy("products.id", "products.cate_id", "products.name", "products.slug", "products.original_price", "products.selling_price", "products.image", "products.created_at")
                ->paginate(4);
            return view('frontend.search.data', compact('products'))->render();
            }
            
            // dd($sort_by);
        }
    }
    public function productview($cate_slug, $prod_slug)
    {
        Category::where('slug', $cate_slug)->firstOrFail();
        $products = Product::where('slug', $prod_slug)->firstOrFail();
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
        return view("frontend.search.index");
    }
    public function searchProduct(Request $request)
    {
        $search_product = $request->product_name;
        if ($search_product != '') {
            $products = Product::where('name', "LIKE", "%$search_product%")->paginate(4);
            if ($products) {
                return view('frontend.search.index', compact('products','search_product'));
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
