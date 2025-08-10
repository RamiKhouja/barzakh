<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Redirect;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'url' => 'nullable',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);
        
        if($request->hasFile('picture')) {
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/partners', $fileName, 'pictures');
        }
        $partner = new Partner;
        $partner->name = $request->input('name');
        $partner->url = $request->input('url');
        $partner->logo = "/partners/{$fileName}";
        $partner->save();

        return Redirect::route('admin.partners')->with('success','Partner has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partner.edit', compact(['partner']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'url' => 'nullable|string'
        // ]);

        $partner->name = $request->input('name');
        $partner->url = $request->input('url');

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->storePublicly('pictures/partners');
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('/partners', $fileName, 'pictures'); 
            $partner->logo="partners/{$fileName}";
        }

        $partner->save();
        return Redirect::route('admin.partners')->with('success','Partner has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners')->with('success', 'Partner deleted successfully');
    }
}
