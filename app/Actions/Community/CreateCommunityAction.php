<?php

namespace App\Actions\Community;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class CreateCommunityAction
{
    public function handle($data)
    {
        $user = Auth::user();

        // Создаем сообщество
        $community = Community::create([
            'creator_id' => $user->id,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        // Подписываем создателя на сообщество
        $community->followers()->attach($user->id);

        return $community;
    }
}
