<?php

namespace App\Services;

use App\Models\Visitor;
use App\Repository\ConfigRepository;
use Illuminate\Http\Request;
use Cookie;
use Cache;

class VisitorService
{
    private $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    public function get()
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        if (auth()->check()) {
            return Cache::tags(Visitor::VISITOR_CACHE_TAGS)
                ->remember('visitor_auth_' . auth()->id(), $ttl, function() {
                    return auth()->user()->visitor ?? Visitor::create(['user_id' => auth()->id()]);
                });
        }

        $visitorId = Cookie::get('visitor_id');

        if (!$visitorId) {
            $visitor = Visitor::create();
            Cookie::queue('visitor_id', $visitor->id, 3600);
            Cache::tags(Visitor::class)->set('visitor_guest_' . $visitor->id, $visitor, $ttl);
            return $visitor;
        }

        return Cache::tags(Visitor::VISITOR_CACHE_TAGS)
            ->remember('visitor_guest_' . $visitorId, $ttl, function() use ($visitorId) {
                return Visitor::find($visitorId);
            });
    }
}
