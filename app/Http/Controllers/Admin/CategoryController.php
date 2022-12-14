<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderby('name', 'asc')->paginate(1);
        return view('admin.category.index', compact('category'));
    }
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('query');
            $search = str_replace(" ", "%", $search);
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $category = Category::where('name', "LIKE", "%$search%")->orWhere('description', "LIKE", "%$search%")->orderBy($sort_by, $sort_type)
                ->paginate(1);
            return view('admin.category.data', compact('category'))->render();
        }
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40|min:5',
            'description' => 'required|string|max:500|min:5',
            'image' => 'required|image',
        ]);
        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = Str::random(15);
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->save();
        return redirect('/categories')->with('status', "Category Added Successfully");
    }
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:40|min:5',
            'description' => 'required|string|max:500|min:5',
        ]);
        $category = Category::where('slug', $slug)->first();
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->update();
        return redirect('/categories')->with('status', "Category Updated Successfully");
    }
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category->image) {
            $path = 'assets/uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/categories')->with('status', "Category Deleted Successfully");
    }
    public function search()
    {
        return view('admin.category.search');
    }
    public function catesearch(Request $request)
    {
        $search = $request->cate_search;
        if ($search != '') {
            $search = str_replace(" ", "%", $search);
            $category = Category::where('name', "LIKE", "%$search%")->orWhere('description', "LIKE", "%$search%")->orderby('name', 'asc')->paginate(1);
            if ($category) {
                return view('admin.category.search', compact('category', 'search'));
            }
        } else {
            return redirect()->back();
        }
    }
}
