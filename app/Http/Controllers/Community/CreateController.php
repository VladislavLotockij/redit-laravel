<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Http\Requests\Community\StoreRequest;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function create()
    {
        return Inertia::render('community/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        // Создаем сообщество
        $community = Community::create([
            'creator_id' => $user->id,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        // Подписываем создателя на сообщество
        $community->followers()->attach($user->id);

        return redirect()->route('home')->with('success', 'Комьюнити успешно создано');
    }
}
