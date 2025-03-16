<?php

namespace App\Actions\Community;

use App\Models\Community;
use Illuminate\Support\Facades\Cache;

class GetAllCommunitiesAction
{
    public function handle($page = 1)
    {
        $cacheKey = 'all_communities_page_' . $page;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($page) {
            return Community::orderByDesc('followers_count')
                ->paginate(10, ['*'], 'page', $page);
        });
    }
}
