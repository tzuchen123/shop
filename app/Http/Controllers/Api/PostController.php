<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        return response()->json(['status' => 0, 'posts' => $this->postRepo->index()]);
    }

    public function store()
    {
        $post = $this->postRepo->create(request()->only('title', 'content'));

        if (!$post) {
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0, 'post' => $post]);
    }

    public function show($id)
    {
        $post = $this->postRepo->find($id);

        if (!$post) {
            return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
        }

        return response()->json(['status' => 0, 'post' => $post]);
    }

    public function update($id)
    {
        $result = $this->postRepo->update($id, request()->only('title', 'content'));

        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
        }

        return response()->json(['status' => 0]);
    }

    public function destroy($id)
    {
        $result = $this->postRepo->delete($id);

        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'], 404);
        }

        return response()->json(['status' => 0]);
    }
}
