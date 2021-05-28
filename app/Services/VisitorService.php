<?php

namespace App\Services;

use App\Models\Visitor;
use App\Repository\ConfigRepository;
use App\Repository\VisitorRepository;
use Illuminate\Http\Request;
use Cookie;
use Cache;

class VisitorService
{
    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepository) {
        $this->visitorRepository = $visitorRepository;
    }

    public function get()
    {
        if (auth()->check()) {
            $visitor = $this->visitorRepository->getAuthVisitor(auth()->id());
        } else {
            $visitorId = Cookie::get('visitor_id');
            $visitor = $this->visitorRepository->getGuestVisitor($visitorId);
            Cookie::queue('visitor_id', $visitor->id, 3600);
        }

        return $visitor;
    }
}
