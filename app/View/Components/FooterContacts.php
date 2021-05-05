<?php

namespace App\View\Components;

use App\Repository\ConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterContacts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public ConfigRepository $configs)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.footer-contacts');
    }
}
