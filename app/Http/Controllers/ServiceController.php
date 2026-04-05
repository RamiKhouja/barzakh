<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByDesc('id')->paginate(15);
        return view('admin.service.index', compact('services'));
    }

    public function clientIndex()
    {
        $services = Service::all();
        return view('client.services', compact('services'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required'
        ]);
        $fileName = null;

        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/services', $fileName, 'pictures');
        }

        $service = new Service;
        $service->title_en = $validated['title_en'];
        $service->title_ar = $validated['title_ar'];
        $service->description_en = $validated['description_en'] ?? null;
        $service->description_ar = $validated['description_ar'] ?? null;
        $service->price = $validated['price'];
        $service->image = $fileName ? "/services/{$fileName}" : null;
        $service->url = Str::slug($validated['title_en']);
        $service->save();

        return Redirect::route('admin.services')->with('success','Service has been created successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.service.show', compact(['service']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit', compact(['service']));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'url' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            // If a new image is uploaded, replace the existing one
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/services', $fileName, 'pictures');
            $service->image = "/services/{$fileName}";
        }

        $service->title_en = $validated['title_en'];
        $service->title_ar = $validated['title_ar'];
        $service->description_en = $validated['description_en'] ?? null;
        $service->description_ar = $validated['description_ar'] ?? null;
        $service->price = $validated['price'];
        $service->url = Str::slug($validated['url']);

        $service->save();

        return redirect()->route('admin.services')->with('success', 'Service has been updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully');
    }

    public function showByUrl($url)
    {
        $service = Service::where('url', $url)->first();
        if (!$service) { abort(404); }

        return view('client.service.show', compact(['service']));
    }
}
