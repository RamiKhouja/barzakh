<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Course;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::whereHas('offers', function ($query) {
            $query->where('status', 'successful');
        })->where('nb_offers', '>', 0)->get();

        return view('client.offers.index', compact('courses'));
    }

    public function adminIndex()
    {
        $offers = Offer::with('user')->with('course')->get();
        return view('admin.offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);

        $offer = new Offer;
        $offer->course_id = $request->input('course_id');
        $offer->user_id = auth()->user()->id;
        $offer->qty = $request->input('qty');
        $offer->amount = round($offer->qty * $request->input('price') , 2);
        
        $offer->save();
        return redirect()->route('requests')->with('success', 'Thank you for contributing');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
