<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    public function index(?string $body): Collection
    {
        return Post::query()
            ->search($body)
            ->get();
    }
}
