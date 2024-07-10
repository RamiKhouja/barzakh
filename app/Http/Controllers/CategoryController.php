<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fields = Field::all();
        return view('admin.category.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'field_id' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/categories', $fileName, 'pictures');
        }
        $category = new Category;
        $category->title_en = $request->input('title_en');
        $category->title_ar = $request->input('title_ar');
        $category->description_en = $request->input('description_en');
        $category->description_ar = $request->input('description_ar');
        $category->field_id = $request->input('field_id');
        $category->url=strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
        $category->image = "/categories/{$fileName}";
        $category->save();

        return Redirect::route('admin.categories')->with('success','Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $fields = Field::all();
        return view('admin.category.edit',compact('category', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'field_id' => 'required',
            'url' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/categories', $fileName, 'pictures');
            $category->image = "/categories/{$fileName}";
        }

        $category->fill($request->post())->save();
        return redirect()->route('admin.categories')->with('success','Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }

    public function showByUrl($url)
    {
        $category = Category::where('url', $url)->first();
        if (!$category) { abort(404); }
        $courses = $category->courses()->paginate(12);

        return view('client.category', compact(['category','courses']));
    }
}
