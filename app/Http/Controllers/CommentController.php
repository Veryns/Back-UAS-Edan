<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Comment; 
use Illuminate\Http\Request; 
 
class CommentController extends Controller 
{ 
    public function store(Request $request) { 
        $request->validate([ 
            'content' => 'required', 
            'post_id' => 'required|exists:posts,id', 
        ]); 
 
        Comment::create([ 
            'content' => $request->content, 
            'post_id' => $request->post_id, 
        ]); 
 
        return back()->with('success', 'Comment added.'); 
    } 
} 