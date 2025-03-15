<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class CreatePostAction
{
    public function handle(array $data): Post
    {
        return Post::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'community_id' => $data['community_id'],
            'image' => isset($data['image']) && $data['image'] instanceof UploadedFile
                ? $data['image']->store('posts', 'public')
                : null,
        ]);
    }
}
