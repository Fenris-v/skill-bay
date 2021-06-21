<?php

namespace App\Http\Middleware;

use App\Services\ProductCartService;
use Closure;
use Illuminate\Http\Request;

class CartIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!app(ProductCartService::class)->count()) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
