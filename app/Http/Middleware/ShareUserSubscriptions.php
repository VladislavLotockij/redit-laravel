<?php

namespace App\Http\Middleware;

use App\Actions\Community\GetSubscriptionCommunitiesAction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ShareUserSubscriptions
{
    private $getSubscriptionCommunities;

    public function __construct(GetSubscriptionCommunitiesAction $getSubscriptionCommunities)
    {
        $this->getSubscriptionCommunities = $getSubscriptionCommunities;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $subscriptions = $this->getSubscriptionCommunities->handle();
            // Передаем данные на все страницы
            Inertia::share([
                'shareUserSubscriptions' => $subscriptions,
            ]);
        }

        return $next($request);
    }
}
