<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();
        return view('gallery.index', compact('photos'));
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $photos = Photo::where('caption', 'like', '%' . $searchTerm . '%')
            ->orWhere('tags', 'like', '%' . $searchTerm . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery.index', compact('photos'));
    }


    public function edit(Photo $photo)
    {
        return view('gallery.edit', compact('photo'));
    }
    
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            Storage::delete($photo->image_path);
            $photo->image_path = $request->file('image')->store('photos', 'public');
        }
    
        $photo->description = $request->description;
        $photo->save();
    
        return redirect()->route('gallery.index')->with('success', 'Foto berhasil diperbarui.');
    }
            
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
    
        $photo->delete();
    
        return redirect()->route('gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
        
    
}
