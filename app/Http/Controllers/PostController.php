<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{

    public function __construct(protected PostRepository $postRepository)
    {
    }

    public function index(CommentRequest $request): View
    {
        $body = $request->validated('body') ?? '';

        $posts = $this->postRepository->index($body);

        return view('posts', ['posts' => $posts]);
    }
}
