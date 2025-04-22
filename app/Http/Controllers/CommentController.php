<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;


class CommentController extends Controller
{
    public function store(Request $request, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
    
        if (!$photo->is_comment_enabled) {
            return redirect()->back()->with('error', 'Komentar dimatikan untuk foto ini.');
        }
    
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $photo->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
    
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
    
    public function __construct()
{
    $this->middleware('auth');
}
public function destroy(Comment $comment)
{
    if (auth()->id() !== $comment->user_id) {
        return back()->with('error', 'Tidak punya izin untuk menghapus komentar ini.');
    }

    $comment->delete();
    return back()->with('success', 'Komentar berhasil dihapus.');
}


}
