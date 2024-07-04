<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function create(PostRequest $request)
    {
        $validatedData = $request->validated();
        if ($validatedData) {
            $post = Post::create($validatedData);
            $post->addMediaFromRequest('image')->toMediaCollection("post_image");
            return responseSuccessMsg("Successfully Created", 200);
        }
    }
}
