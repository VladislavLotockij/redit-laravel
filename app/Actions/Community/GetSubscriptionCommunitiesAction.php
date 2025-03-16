<?php

namespace App\Actions\Community;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GetSubscriptionCommunitiesAction
{
    public function handle()
    {
        $userId = Auth::id();
        $cacheKey = 'user_' . $userId . '_subscriptions';

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return Auth::user()->communities()->get();
        });
    }
}
