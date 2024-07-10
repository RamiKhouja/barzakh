<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Course;
use App\Models\CoursePack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packs = Pack::with('courses')->get();
        return view('admin.pack.index', compact('packs'));
    }

    public function clientIndex()
    {
        $packs = Pack::with('courses')->get();
        return view('client.pack.index', compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.pack.create', compact(['courses']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'domain_en' => 'nullable',
            'domain_ar' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'courses' => 'required',
        ]);
        
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/packs', $fileName, 'pictures');
        }

        $pack = new Pack;
        $pack->setTranslation('name', 'en', $request->input('name_en'));
        $pack->setTranslation('name', 'ar', $request->input('name_ar'));
        $pack->setTranslation('description', 'en', $request->input('description_en'));
        $pack->setTranslation('description', 'ar', $request->input('description_ar'));
        $pack->setTranslation('domain', 'en', $request->input('domain_en'));
        $pack->setTranslation('domain', 'ar', $request->input('domain_ar'));
        $pack->price = $request->input('price');
        $pack->image = "/packs/{$fileName}";
        $pack->url = strtolower(str_replace(' ', '-', trim($request->input('name_en'))));
        $orig_price = 0;
        $courses = $request->input('courses');
        foreach ($courses as $course) {
            $crs = Course::findOrFail($course);
            $orig_price+=$crs->price;
        }
        $pack->orig_price = $orig_price;
        $pack->save();

        foreach ($courses as $course) {
            $crs = Course::findOrFail($course);
            CoursePack::create([
                'pack_id' => $pack->id,
                'course_id' => $crs->id
            ]);
        }

        return Redirect::route('admin.packs')->with('success','Pack has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pack $pack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pack $pack)
    {
        $courses = Course::all();
        $selectedCourses = CoursePack::where('pack_id', $pack->id)->pluck('course_id')->toArray();
        return view('admin.pack.edit', compact(['pack','courses', 'selectedCourses']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pack $pack)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'domain_en' => 'nullable',
            'domain_ar' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'courses' => 'required',
        ]);

        if ($request->hasFile('picture')) {
            // If a new image is uploaded, replace the existing one
            $path = $request->file('picture')->storePublicly('pictures/packs');
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/packs', $fileName, 'pictures'); 
            $pack->image="/packs/{$fileName}";
        }

        $pack->setTranslation('name', 'en', $request->input('name_en'));
        $pack->setTranslation('name', 'ar', $request->input('name_ar'));
        $pack->setTranslation('description', 'en', $request->input('description_en'));
        $pack->setTranslation('description', 'ar', $request->input('description_ar'));
        $pack->setTranslation('domain', 'en', $request->input('domain_en'));
        $pack->setTranslation('domain', 'ar', $request->input('domain_ar'));
        $pack->price = $request->input('price');
        $orig_price = 0;
        $courses = $request->input('courses');
        foreach ($courses as $course) {
            $crs = Course::findOrFail($course);
            $orig_price+=$crs->price;
        }
        $pack->orig_price = $orig_price;
        $pack->save();

        $courseIds = $request->input('courses', []);
        $pack->courses()->detach();
        foreach ($courseIds as $courseId) {
            $pack->courses()->attach($courseId);
        }

        return redirect()->route('admin.packs')->with('success', 'Pack has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Pack $pack)
    {
        $pack->delete();
        return redirect()->route('admin.packs')->with('success', 'Pack deleted successfully');
    }
}
