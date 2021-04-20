<?php

namespace App\View\Components\Banners;

use App\Models\Banner;
use Illuminate\View\Component;

class BannersItem extends Component
{
    /**
     * @var Banner
     */
    public $banner;

    /**
     * Create a new component instance.
     *
     * @param  Banner  $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banners.banners-item');
    }
}
