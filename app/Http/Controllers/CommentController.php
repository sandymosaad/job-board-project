<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(3);
        return view('posts.show', compact('comments'));    /////

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $user = Auth::user();
        // return view('comments.create', compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->user()->id;
        $comment->commentable_id = $request->input('post_id');
        $comment->commentable_type = 'App\Models\Post';  // Assuming comments are for posts
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
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

    public function edit(string $id)

    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Comment $comment)
    {
        
        if (auth()->user()->id !== $comment->user_id && auth()->user()->type !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
       
    }
}