<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth')->except(['index','show']);
    //     // OR
    //     $this->middleware('auth')->only(['profile']);
    // }

    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        $formData['password'] = bcrypt($request['password']);
        $formData['remember_token'] = Str::random(10);

        if($request->hasFile('image')) {
            $formData['image'] = $request->file('image')->store('user-images', 'public');
        }

        $user = User::create($formData);
        
        event(new Registered($user));

        return redirect('/email/verify');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formData = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);
        
        if(auth()->attempt($formData)){
            $request->session()->regenerate();

            if(auth()->user()->email_verified_at) {
                return redirect('/')->with('message', 'successfuly logged in!');
            }

                return redirect(route('verification.notice'));
        }

        
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout successful.');
    }

    public function profile(User $user) {
        return view('users.profile.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $formData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $formData['password'] = bcrypt($formData['password']);

        if($request->hasFile('image')) {
            $formData['image'] = $request->file('image')->store('user-images', 'public');
        }

        if (!Hash::check($request->old_password, $user->password)) { 
            return back()->with('message', 'Wrong old password!');
        } 
        
        $user->update($formData);

        return back()->with('message', 'Update successful.');
    }

    public function user_posts(User $user) {
        $user->load('post.user', 'post.comment', 'comment.user');

        return view('users.profile.user-posts', compact('user'));
    }

    public function user_comments(User $user) {
        $user->load('comment.post');

        return view('users.profile.user-comments', compact('user'));
    }

    public function destroy(User $user) {
        $user->delete();

        return back('/');
    }

    public function admin_users() {
        return view('users.admin.admin-users', [
            'users' => User::all(),
        ]);
    }

    public function admin_posts() {
        return view('users.admin.admin-posts', [
            'posts' => Post::latest()->get(),
        ]);
    }

    public function admin_comments() {
        return view('users.admin.admin-comments', [
            'comments' => Comment::latest()->get()
        ]);
    }
}
