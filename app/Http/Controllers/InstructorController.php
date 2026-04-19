<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Instructor;
use App\Models\Course;

class InstructorController extends Controller
{
    public function index() 
    {
        $instructors = Instructor::orderBy('order')->get();
        return view('admin.instructor.index', compact('instructors'));
    }

    public function clientIndex() {
        $instructors = Instructor::orderBy('order','asc')->get();
        return view('client.instructors', compact('instructors'));
    }

    public function create()
    {
        $lastInstructor = Instructor::where('order', '!=', 99)
                                    ->orderBy('order', 'desc')
                                    ->first();
        $order = $lastInstructor ? $lastInstructor->order + 1 : 1;
        return view('admin.instructor.create', compact('order'));
    }

    public function store(Request $request): RedirectResponse
    {
        $instructor = new Instructor;

        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/instructors', $fileName, 'pictures');
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
        $instructor->image = "/instructors/{$fileName}";
        $instructor->url = strtolower(str_replace(' ', '-', trim($request->input('firstname_en')." ".$request->input('lastname_en'))));
        $instructor->order = $request->input('order');

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
            'url' => 'required|string',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('instructors')->ignore($instructor->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:1',
        ]);
        
        $oldOrder = $instructor->order;
        $newOrder = $request->input('order');

        DB::beginTransaction();

        try {
            if ($newOrder && $newOrder != $oldOrder) {
                if ($newOrder < $oldOrder) {
                    Instructor::where('order', '>=', $newOrder)
                        ->where('order', '<', $oldOrder)
                        ->increment('order');
                } else {
                    Instructor::where('order', '<=', $newOrder)
                        ->where('order', '>', $oldOrder)
                        ->decrement('order');
                }
            }

            $instructor->setTranslation('firstname', 'en', $request->input('firstname_en'));
            $instructor->setTranslation('firstname', 'ar', $request->input('firstname_ar'));
            $instructor->setTranslation('lastname', 'en', $request->input('lastname_en'));
            $instructor->setTranslation('lastname', 'ar', $request->input('lastname_ar'));
            $instructor->setTranslation('short_desc', 'en', $request->input('short_desc_en'));
            $instructor->setTranslation('short_desc', 'ar', $request->input('short_desc_ar'));
            $instructor->setTranslation('description', 'en', $request->input('description_en'));
            $instructor->setTranslation('description', 'ar', $request->input('description_ar'));
            $instructor->email = $request->input('email');
            $instructor->url = $request->input('url');
            $instructor->order = $newOrder;

            if ($request->hasFile('picture')) {
                $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
                $request->file('picture')->storeAs('/instructors', $fileName, 'pictures'); 
                $instructor->image = "/instructors/{$fileName}";
            }

            $instructor->save();

            DB::commit();

            return redirect()->route('admin.instructors')->with('success','Instructor has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error while updating instructor: ' . $e->getMessage());
        }
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'instructors' => 'required|array|min:1',
            'instructors.*' => 'required|integer|distinct|exists:instructors,id',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['instructors'] as $index => $instructorId) {
                Instructor::where('id', $instructorId)->update([
                    'order' => $index + 1,
                ]);
            }
        });

        return response()->json([
            'message' => __('admin.instructors_reordered'),
        ]);
    }

    public function showByUrl($url)
    {
        $instructor = Instructor::where('url', $url)->first();
        if (!$instructor) { abort(404); }

        return view('client.instructor', compact('instructor'));
    }

    public function delete(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('admin.instructors')->with('success', 'Instructor deleted successfully');
    }
}
