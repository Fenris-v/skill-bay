<?php

namespace App\View\Components\Banners;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Banners extends Component
{
    /**
     * @var Collection|Banner[]
     */
    public $banners;

    /**
     * Create a new component instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        $this->banners = cache()->remember(
            'banners',
            config('banners.cache_duration'),
            function () {
                return Banner::active()
                    ->inRandomOrder()
                    ->take(3)
                    ->with('image')
                    ->get();
            }
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banners.banners');
    }
}
