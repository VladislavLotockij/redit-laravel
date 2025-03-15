<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateControler extends Controller
{
    public function create()
    {
        $communities = Community::all();

        return Inertia::render('post/Create', [
            'communities' => $communities,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'community_id' => $validatedData['community_id'],
            'image' => $request->file('image') ? $request->file('image')->store('posts', 'public') : null,
        ]);

        return redirect()->route('home')->with('success', 'Пост успешно создан!');
    }
}
