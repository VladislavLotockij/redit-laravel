<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\CreatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateControler extends Controller
{
    private $createPost;
    public function __construct(CreatePostAction $createPost)
    {
        $this->createPost = $createPost;
    }

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

        $this->createPost->handle($request->validated() + ['image' => $request->file('image')]);

        return redirect()->route('home')->with('success', 'Пост успешно создан!'); //TODO: поменять редирект
    }
}
