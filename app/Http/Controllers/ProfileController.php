<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $status = $request->query('status', 'waiting'); 
        $applications = Application::where('user_id', Auth::id())
            ->where('status', $status)
            ->paginate(10);

        return view('auth.profile', [
            'applications' => $applications,
            'currentStatus' => $status,
            'user' => Auth::user() 
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($user->image) {
                Storage::disk('profile_images')->delete($user->image);
            }

            $my_path = $image->store('profile_images', 'profile_images');
            $user->image = $my_path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'data updated successfuly.');
    }
}
