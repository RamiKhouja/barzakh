<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
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
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required'
        ]);
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/services', $fileName, 'pictures');
        }

        $service = new Service;
        $service->title_en = $request->input('title_en');
        $service->title_ar = $request->input('title_ar');
        $service->description_en = $request->input('description_en');
        $service->description_ar = $request->input('description_ar');
        $service->price = $request->input('price');
        $service->image = "/services/{$fileName}";
        $service->url = strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
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
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            // If a new image is uploaded, replace the existing one
            $path = $request->file('picture')->storePublicly('pictures/services');
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/services', $fileName, 'pictures'); 
            $service->image="/services/{$fileName}";
        }

        $service->title_en = $request->input('title_en');
        $service->title_ar = $request->input('title_ar');
        $service->description_en = $request->input('description_en');
        $service->description_ar = $request->input('description_ar');
        $service->price = $request->input('price');
        $service->url = $request->input('url');
        
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

        return view('client.service.show', compact(['course']));
    }
}
