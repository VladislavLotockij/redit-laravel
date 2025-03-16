<?php

namespace App\Actions\Community;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GetSubscriptionCommunitiesAction
{
    public function handle($page = 1)
    {
        $userId = Auth::id();
        $cacheKey = 'user_' . $userId . '_subscriptions_page_' . $page;

        $subscriptions = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($page) {
            return Auth::user()->communities()->paginate(10, ['*'], 'page', $page);
        });
        return $subscriptions;
    }
}
