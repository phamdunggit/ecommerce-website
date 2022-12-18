<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderby('id', 'asc')->paginate(1);
        return view('admin.product.index', compact('products'));
    }
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $products = Product::leftJoin('categories', 'products.cate_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as cate_name')
            ->where('products.name', "LIKE", "%$search%")
            ->orWhere('products.description', "LIKE", "%$search%")
            ->orWhere('categories.name', "LIKE", "%$search%")
            ->orderBy($sort_by, $sort_type)
                ->paginate(1);
            return view('admin.product.data', compact('products'))->render();
        }
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40|min:5',
            'description' => 'required|string|max:500|min:5',
            'image' => 'required|image',
            'cate_id' => 'required',
            'original_price' => 'required|digits_between:1,10',
            'selling_price' => 'required|digits_between:1,10',
            'qty' => 'required|digits_between:1,10',
            'banner' => 'required|image',
            'image_details.*' => 'required|image|mimes:jpg,jpeg,png',
            'image_details' => 'required',
        ]);
        // $producttype=new ProductType();
        $product = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/product/image/', $filename);
            $product->image = $filename;
        }


        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = Str::random(15);
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE ? '1' : '0';
        $product->save();
        $product_type = new ProductType();
        $product_type->prod_id = $product->id;
        $product_type->hot = $request->input('hot') == TRUE ? '1' : '0';
        $product_type->best_selling = $request->input('best_selling') == TRUE ? '1' : '0';
        $product_type->new = $request->input('new') == TRUE ? '1' : '0';
        $product_type->save();
        $banner = new Banner();
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/product/banner/', $filename);
            $banner->banners = $filename;
            $banner->prod_id = $product->id;
        }
        $banner->save();
        if ($request->hasFile('image_details')) {
            $files = $request->file('image_details');
            foreach ($files as $file) {
                $productimage = new ProductImage();
                $ext = $file->getClientOriginalExtension();
                $filename = Str::random(3) . time() . '.' . $ext;
                $file->move('assets/uploads/product/image_detail/', $filename);
                $productimage->images = $filename;
                $productimage->prod_id = $product->id;
                $productimage->save();
            }
        }
        return redirect('/products')->with('status', "Product Added Successfully");
    }
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $category = Category::all();
        return view('admin.product.edit', compact('product','category'));
    }
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:40|min:5',
            'description' => 'required|string|max:500|min:5',
            'cate_id' => 'required',
            'original_price' => 'required|digits_between:1,10',
            'selling_price' => 'required|digits_between:1,10',
            'qty' => 'required|digits_between:1,10',
        ]);
        $product = Product::where('slug', $slug)->first();
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/product/image/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/product/image/', $filename);
            $product->image = $filename;
        }
        $product->name = $request->input('name');
        $product->cate_id = $request->input('cate_id');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE ? '1' : '0';
        $product->update();
        $product_type = ProductType::where('prod_id', $product->id)->first();
        $product_type->hot = $request->input('hot') == TRUE ? '1' : '0';
        $product_type->best_selling = $request->input('best_selling') == TRUE ? '1' : '0';
        $product_type->new = $request->input('new') == TRUE ? '1' : '0';
        $product_type->update();
        $banner = Banner::where('prod_id', $product->id)->first();
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $path = 'assets/uploads/product/banner/' . $banner->banners;
            if (File::exists($path)) {
                File::delete($path);
            }
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/product/banner/', $filename);
            $banner->banners = $filename;
            $banner->prod_id = $product->id;
        }
        $banner->update();

        if ($request->hasFile('image_details')) {
            $productimages = ProductImage::where('prod_id', $product->id)->get();
            foreach ($productimages as $image) {
                if ($image) {
                    $path = 'assets/uploads//product/image_detail/' . $image->images;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $image->delete();
                }
            }
            $files = $request->file('image_details');
            foreach ($files as $file) {
                $productimage = new ProductImage();
                $ext = $file->getClientOriginalExtension();
                $filename = Str::random(3) . time() . '.' . $ext;
                $file->move('assets/uploads/product/image_detail/', $filename);
                $productimage->images = $filename;
                $productimage->prod_id = $product->id;
                $productimage->save();
            }
        }
        return redirect('/products')->with('status', "Product Edited Successfully");
    }
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product->image) {
            $path = 'assets/uploads//product/image/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        $product_type=ProductType::where('prod_id', $product->id)->first();
        $product_type->delete();
        $banner = Banner::where('prod_id', $product->id)->first();
        if ($banner->banners) {
            $path = 'assets/uploads/product/banner/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $banner->delete();
        }
        $productimages = ProductImage::where('prod_id', $product->id)->get();
            foreach ($productimages as $image) {
                if ($image) {
                    $path = 'assets/uploads//product/image_detail/' . $image->images;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $image->delete();
                }
            }
        return redirect('/products')->with('status', "Products Deleted Successfully");
    }
    public function search()
    {
        return view('admin.product.search');
    }
    public function prodsearch(Request $request)
    {
        $search_prod=$request->prod_search;
        if ($search_prod!='') {
            $products=Product::leftJoin('categories', 'products.cate_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as cate_name')
            ->where('products.name',"LIKE","%$search_prod%")
            ->orWhere('products.description',"LIKE","%$search_prod%")
            ->orWhere('categories.name',"LIKE","%$search_prod%")
            ->paginate(1);
            if($products){
                return view('admin.product.search',compact('products'));
            }
        } else {
            return redirect()->back();
        }
    }
}
