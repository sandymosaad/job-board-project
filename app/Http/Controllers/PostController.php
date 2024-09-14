<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index(Request $request)
    {
        $status = $request->query('status');

        //my posts

        if ($status === 'approved') {
            $posts = Post::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($status === 'pending') {
            $posts = Post::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($status === 'rejected') {
            $posts = Post::where('user_id', Auth::id())
                ->where('status', 'rejected')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            return redirect()->route('posts.index', ['status' => 'approved']);
        }

        return view('posts.index', ['posts' => $posts, 'status' => $status]);

    }



    public function create(Post $post)
    {

        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to create posts.');
        }


        $user = Auth::user();
        if ($user->type !== 'employer') {
            abort(403, 'Access denied. Only employers can create posts.');
        }


        $users = User::all();
        return view('posts.create', compact('users', 'post'));
    }
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $logoPath = "";
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('images', 'logo');
            $data['logo'] = $logoPath;
        }
        $post = new Post($data);
        $post->save();
        //dd($post);

        //Post::create($data);

        return redirect()->route('posts.index');
    }

    // $post = new Post($data);
    // $post->save();
    // return redirect()->route('posts.index');

    public function show(Post $post)
    {
    }
    public function showForEveryOne($id)
    {

        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to view posts.');
        }
        $user = Auth::user();

        $post = Post::with(['comments.user'])->findOrFail($id);
        // dd($post);

        return view('posts.showforeveryone', compact('post'));
    }


    public function edit(Post $post)
    {
        // if (!Auth::check()) {
        //     return redirect('/login')->with('error', 'Please log in to edit posts.');
        // }



        $user = Auth::user();
        if ($user->type !== 'employer') {
            abort(403, 'Access denied. Only employers can edit posts.');
        }

        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    //     public function update(UpdatePostRequest $request, Post $post)
//     {
//         $data = $request->validated();
//
//         $user = Auth::user();
//         if ($user->type !== 'employer') {
//             abort(403, 'Access denied. Only employers can edit posts.');

    //         }
//         $users = User::all();
//         return view('posts.edit', compact('users'), compact('post'));
//     }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        // dd($data);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('images', 'logo');
            $data['logo'] = $logoPath;
        }
        $post->update($data);
        // dd($data);
        //dd($post);
        return redirect()->route('posts.index');

    }


    // public function showforeveryone(Post $post)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/login')->with('error', 'Please log in to view posts.');
    //     }


    //     $post = Post::with(['comments.user'])->findOrFail($post->id);

    //     return view('posts.showforeveryone', compact('post'));
    // }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function search(Request $request)
    {
        // dd($request);
        // $posts = Post::where("category","like","%". $request->category ."%")->paginate(10);
        $posts = Post::where('category', 'like', '%' . $request->search . '%')
            ->orderBy('created_at', 'desc')->get();
            // dd($posts);

        if ($posts->count() > 0) {
            return view("posts.search", compact("posts"));
        } else {
            return to_route("home")->with('error', 'No Result Found');
        }

    }

    //filter
    public function filter(Request $request)
    {
        // Start building the query
        $query = Post::query();
        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('location', 'like', "%$searchTerm%");
            });
        }
        // Apply filters if they are present

        if ($request->filled('title')) {
            $query->where('title', 'like', "%{$request->input('title')}%");
        }

        if ($request->filled('deadline')) {
            $query->whereDate('deadline', $request->input('deadline'));
        }

        if ($request->filled('workType')) {
            $query->where('workType', $request->input('workType'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->input('location')}%");
        }

        // Fetch filtered posts
        $posts = $query->get();

        // Return the view with posts and the current filter values
        return view('posts.search', [
            'posts' => $posts,
        ]);
    }
}