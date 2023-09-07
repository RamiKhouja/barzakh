<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class WelcomeController extends Controller
{
    public function index() 
    {
        $fields = Field::all();
        return view('welcome', compact(['fields']));
    }
}