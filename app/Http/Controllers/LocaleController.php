<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        $locale = $request->input('locale');
        app()->setLocale($locale);
        // Validate the selected locale here if needed

        // Set a cookie to store the locale preference
        return redirect()->back()->withCookie(cookie('locale', $locale, 60 * 24 * 30));
    }
}
