<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use App\Models\Instructor;
use App\Models\Course;

class InstructorController extends Controller
{
    public function index() 
    {
        $instructors = Instructor::all();
        return view('admin.instructor.index', compact('instructors'));
    }

    public function create()
    {
        return view('admin.instructor.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $instructor = new Instructor;

        $path = null;
        if($request->hasFile('picture')) {
            $path = $request->file('picture')->storePublicly('pictures/instructors');
        }
        $instructor->sex = $request->input('sex');
        $instructor->setTranslation('firstname', 'en', $request->input('firstname_en'));
        $instructor->setTranslation('firstname', 'ar', $request->input('firstname_ar'));
        $instructor->setTranslation('lastname', 'en', $request->input('lastname_en'));
        $instructor->setTranslation('lastname', 'ar', $request->input('lastname_ar'));
        $instructor->setTranslation('short_desc', 'en', $request->input('short_desc_en'));
        $instructor->setTranslation('short_desc', 'ar', $request->input('short_desc_ar'));
        $instructor->setTranslation('description', 'en', $request->input('description_en'));
        $instructor->setTranslation('description', 'ar', $request->input('description_ar'));
        $instructor->email = $request->input('email');
        $instructor->phone = $request->input('phone');
        $instructor->country = $request->input('country');
        $instructor->image = $path;

        $instructor->save();
        
        return Redirect::route('admin.instructors')->with('success','Instructor has been created successfully.');
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructor.edit',compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'firstname_en' => 'required|string',
            'lastname_en' => 'required|string',
            'firstname_ar' => 'required|string',
            'lastname_ar' => 'required|string',
            'short_desc_en' => 'nullable',
            'short_desc_ar' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('instructors')->ignore($instructor->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $instructor->setTranslation('firstname', 'en', $request->input('firstname_en'));
        $instructor->setTranslation('firstname', 'ar', $request->input('firstname_ar'));
        $instructor->setTranslation('lastname', 'en', $request->input('lastname_en'));
        $instructor->setTranslation('lastname', 'ar', $request->input('lastname_ar'));
        $instructor->setTranslation('short_desc', 'en', $request->input('short_desc_en'));
        $instructor->setTranslation('short_desc', 'ar', $request->input('short_desc_ar'));
        $instructor->setTranslation('description', 'en', $request->input('description_en'));
        $instructor->setTranslation('description', 'ar', $request->input('description_ar'));
        $instructor->email = $request->input('email');
        
        $path = $instructor->image;
        if ($request->hasFile('picture')) {
            // If a new image is uploaded, replace the existing one
            $path = $request->file('picture')->storePublicly('pictures/instructors');
        }
        $instructor->image=$path;
        
        $instructor->save();

        return redirect()->route('admin.instructors')->with('success','Instructor Has Been updated successfully');
    }

    public function showByUrl($url)
    {
        $instructor = Instructor::where('url', $url)->first();
        if (!$instructor) { abort(404); }

        return view('client.instructor', compact('instructor'));
    }
}
