<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('comment', 'user')->latest()->filter(request(['search']))->simplePaginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'title' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ]);

        $formData['slug'] = str_slug($formData['title']);
        $formData['user_id'] = auth()->id();

        if($request->hasFile('image')) {
            $formData['image'] = $request->file('image')->store('images', 'public');
        }

        Post::create($formData);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('comment', 'comment.user');

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $formData = $request->validate([
            'title' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ]);

        $formData['slug'] = str_slug($formData['title']);

        $post->update($formData);

        return redirect('/')->with('message', 'Post successfuly updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/');
    }
}
