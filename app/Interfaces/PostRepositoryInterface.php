<?php

namespace App\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function notify(Post $post, bool $retroactive = false);
}
