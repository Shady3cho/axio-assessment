<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{

    public function notify(Post $post, bool $retroactive = false)
    {
        // TODO: Implement notify() method.
    }
}
