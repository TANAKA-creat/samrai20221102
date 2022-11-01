<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ReturnComment;

class ReturnCommentController extends Controller
{
    public function store(Request $request , Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $return_comment = new ReturnComment();
        $return_comment->post_id = $post->id;
        $return_comment->body = $request->body;
        $return_comment->save();

        return redirect()
         ->route('posts.show', $post);
    }

    public function destroy (ReturnComment $return_comment)
    {
        $return_comment->delete();

        return redirect()
            ->route('posts.show', $return_comment->post);
    }
}
