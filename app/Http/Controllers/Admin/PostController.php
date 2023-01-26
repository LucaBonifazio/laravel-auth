<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PostController extends Controller
{
    private $validationChecks = [
        'slug'      => 'string|required|max:100',
        'title'     => 'string|required|max:100',
        'image'    => 'https://picsum.photos/id/'. 'rand(0, 1000)' .'500/400',
        'content'   => 'nullable|boolean',
        'excerpt' => 'nullable|date',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationChecks);

        $data = $request->all();

        $post = Post::create($data);

        return redirect()->route('admin.posts.show', ['post' => $post])->with('success_create', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationChecks);

        $data = $request->all();

        $post->slug        = $data['slug'];
        $post->title       = $data['title'];
        $post->image      = $data['image'];
        $post->content     = $data['content'];
        $post->excerpt   = $data['excerpt'];
        $post->update();

        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success_delete', $post->id);
    }
}
