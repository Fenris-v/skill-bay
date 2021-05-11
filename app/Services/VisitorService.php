<?php

namespace App\Services;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Cookie;

class VisitorService
{

    public function get()
    {
        if (auth()->check()) {
            $visitor = auth()->user()->visitor ?? Visitor::create(['user_id' => auth()->id()]);

        } else {
            $visitorId = Cookie::get('visitor_id');

            if (!($visitor =  Visitor::find($visitorId))) {
                $visitor = Visitor::create();
                Cookie::queue('visitor_id', $visitor->id, 3600);
            }
        }

        return $visitor;

    }
}
