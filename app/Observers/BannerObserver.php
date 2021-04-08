<?php

namespace App\Observers;

use App\Models\Banner;

class BannerObserver
{
    /**
     * Handle the Banner "updated" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     * @throws \Exception
     */
    public function saved(Banner $banner)
    {
        cache()->forget('banners');
    }

    /**
     * Handle the Banner "deleted" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     * @throws \Exception
     */
    public function deleted(Banner $banner)
    {
        cache()->forget('banners');
    }
}
