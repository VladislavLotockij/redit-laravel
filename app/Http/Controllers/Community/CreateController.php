<?php

namespace App\Http\Controllers\Community;

use App\Actions\Community\CreateCommunityAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Community\StoreRequest;
use Inertia\Inertia;

class CreateController extends Controller
{
    private $createCommunity;

    public function __construct(CreateCommunityAction $createCommunity)
    {
        $this->createCommunity = $createCommunity;
    }

    public function create()
    {
        return Inertia::render('community/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->createCommunity->handle($data);

        return redirect()->route('home')->with('success', 'Комьюнити успешно создано');
    }
}
