<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo; 

class WelcomeController extends Controller
{
    public function index() {
        $photos = Photo::latest()->get(); 
        return view('welcome', compact('photos'));
    }
}
