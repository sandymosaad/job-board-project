<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JobBoardController extends Controller
{
    public function index()
    {
        
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Access denied. Login o view this page.You do not have permission');
        }
      
        $posts = Post::where('status', 'approved')->get();
        return view('jobboard.home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('jobboard.show', compact('post'));
    }
}
