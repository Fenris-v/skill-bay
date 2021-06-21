<?php

namespace App\Services;

use App\Models\Visitor;
use App\Repository\VisitorRepository;
use Cookie;
use App\Contracts\VisitorService as VisitorServiceInterface;

class VisitorService implements VisitorServiceInterface
{
    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepository) {
        $this->visitorRepository = $visitorRepository;
    }

    public function get(): Visitor
    {
        return auth()->check()
            ? $this->visitorRepository->getAuthVisitor(auth()->id())
            : $this->getGuest()
        ;

        return $visitor;
    }

    public function getGuest(): Visitor
    {
        $visitorId = Cookie::get('visitor_id');
        $visitor = $this->visitorRepository->getGuestVisitor($visitorId);
        Cookie::queue('visitor_id', $visitor->id, 3600);

        return $visitor;
    }
}
