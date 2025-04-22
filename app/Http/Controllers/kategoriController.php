<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function show($nama)
    {
        $data = Gambar::where('kategori', $id)->get();
        return view('kategori.show', compact('data', 'nama'));
    }
    
    public function index()
{
    $categories = Category::all(); // atau sesuai kebutuhan
    return view('view', compact('categories'));
}

}
