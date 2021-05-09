<?php

namespace App\Http\Controllers;

use App\Repository\CallbackRepository;
use App\Repository\ConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class InfoPageController extends Controller
{
    /**
     * @param ConfigRepository $configs
     * @return View
     */
    public function contacts(ConfigRepository $configs): View
    {
        return view('pages.info.contacts', compact('configs'));
    }

    /**
     * @param ConfigRepository $configs
     * @return View
     */
    public function about(ConfigRepository $configs): View
    {
        return view('pages.info.about', compact('configs'));
    }

    /**
     * @param CallbackRepository $callback
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CallbackRepository $callback): RedirectResponse
    {
        $callback->createCallback(request());

        session()->flash('callback', __('general.message_send'));

        return back();
    }
}
