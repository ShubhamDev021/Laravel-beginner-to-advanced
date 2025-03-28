<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::withTrashed()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // return $request->all();

        $data = $request->all();
        $data['user_id'] = 1;

        Post::create($data);

        //creating a flash session
        $request->session()->flash('alert-success', 'Post created successfully');

        // return view('posts.create', compact('message'));

        // return redirect('posts/create');
        return redirect()->route('posts.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->is_active = $request->is_active;
        $post->is_published = $request->is_published;
        $post->save();

        //creating a flash session
        $request->session()->flash('alert-success', 'Post updated successfully');

        return redirect()->route('posts.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }

        $post->delete();

        //creating a flash session
        request()->session()->flash('alert-success', 'Post deleted successfully');

        return redirect()->route('posts.index'); 
    }

    public function undo_soft_delete($id) {
        $post = Post::withTrashed()->find($id);
        if (!$post) {
            abort(404);
        }

        $post->update([
            'deleted_at' => null
        ]);

        //creating a flash session
        request()->session()->flash('alert-success', 'Post restored successfully');

        return redirect()->route('posts.index'); 
    }
}
