<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Field;

class FieldController extends Controller
{
    public function index() 
    {
        $fields = Field::all();
        return view('admin.field.index', compact('fields'));
    }

    public function create()
    {
        return view('admin.field.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $field = new Field;
        $field->setTranslation('title', 'en', $request->input('title_en'));
        $field->setTranslation('title', 'ar', $request->input('title_ar'));
        $field->setTranslation('subtitle', 'en', $request->input('subtitle_en'));
        $field->setTranslation('subtitle', 'ar', $request->input('subtitle_ar'));
        $field->setTranslation('description', 'en', $request->input('description_en'));
        $field->setTranslation('description', 'ar', $request->input('description_ar'));
        $field->url=strtolower(str_replace(' ', '-', trim($request->input('title_en'))));
        $field->save();

        return Redirect::route('admin.fields')->with('success','Study axe has been created successfully.'); 
    }
}
