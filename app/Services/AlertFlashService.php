<?php

namespace App\Services;

class AlertFlashService
{
    public function message(string $message): AlertFlashService
    {
        session()->flash('message', $message);

        return $this;
    }

    public function lang(string $key, array $values = []): AlertFlashService
    {
        session()->flash('message', __($key, $values));

        return $this;
    }

    public function danger(): AlertFlashService
    {
        session()->flash('alertType', 'danger');

        return $this;
    }

    public function warning(): AlertFlashService
    {
        session()->flash('alertType', 'warning');

        return $this;
    }

    public function success(): AlertFlashService
    {
        session()->flash('alertType', 'success');

        return $this;
    }

    public function info(): AlertFlashService
    {
        session()->flash('alertType', 'info');

        return $this;
    }
}
