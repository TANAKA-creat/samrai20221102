<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //index
    public function index()
    {
        $posts = Post::latest()->get();

        return view('index')
        ->with(['posts'=>$posts]);
    }

        //show
        public function show(Post $post)
         {
            return view('posts.show')
            ->with(['post'=> $post]);
        }

        //create
        public function create()
        {
            return view('posts.create');
        }

        //store
        public function store(PostRequest $request)
        {
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return redirect()
                ->route('posts.index');

            if(request('image')) {
                $original=request()->file('image')->getClientOriginalName();
                $name=date('Ymd_His').'_'.$original;
                request()->file('image')->move('storage/image',$name);
                $post->image=$name();

                return redirect()
                    ->route('posts.show');
            }
        }

        //edit
        public function edit(Post $post)
        {
            return view('posts.edit')
             ->with(['post'=> $post]);
        }

        //update
        public function update(PostRequest $request, Post $post)
        {
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return redirect()
                ->route('posts.show', $post);
        }

        //delete
        public function destroy(Post $post)
        {
            $post->delete();

            return redirect()
                ->route('posts.index');
        }
}

