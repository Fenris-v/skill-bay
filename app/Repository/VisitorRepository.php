<?php


namespace App\Repository;

use App\Models\User;
use App\Models\Visitor;
use Cache;
use Cookie;

class VisitorRepository
{
    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * VisitorRepository constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function getAuthVisitor($userId)
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Visitor::VISITOR_CACHE_TAGS,
        ])->remember('visitor_auth_' . $userId, $ttl, function() use ($userId) {
            return Visitor::where('user_id', $userId)->first() ?? Visitor::create(['user_id' => $userId]);
        });
    }

    public function getGuestVisitor($visitorId = null)
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        $visitor = null;

        if ($visitorId) {
            $visitor = Cache::tags([
                Visitor::VISITOR_CACHE_TAGS,
                ConfigRepository::GLOBAL_CACHE_TAG,
            ])->remember('visitor_guest_' . $visitorId, $ttl, function() use ($visitorId) {
                return Visitor::find($visitorId);
            });
        }

        if (!$visitor) {
            $visitor = Visitor::create();
            Cache::tags([
                Visitor::class,
                ConfigRepository::GLOBAL_CACHE_TAG,
            ])->set('visitor_guest_' . $visitor->id, $visitor, $ttl);
        }

        return $visitor;
    }


}
