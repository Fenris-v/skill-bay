<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\AlertFlashService;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(
        protected AlertFlashService $alert,
        protected UserRepository $userRepository
    ) {}

    public function stepPersonal()
    {
        return view('pages.main.order', [
            'completedSteps' => [],
            'component' => 'order.personal',
        ]);
    }

    public function stepPersonalStore(Request $request)
    {
//        if ($this->userRepository->emailExists((string) $request->email)) {
//            $this->alert->lang('orderPage.errors.userAlreadyExists')->danger();
//            return back()->withInput();
//        }
        $this->userRepository
            ->store($request->only([
                'name',
                'phone',
                'email',
                'password',
                'password_confirmation'
            ]
        ));
    }

    public function stepDelivery()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal'],
            'component' => 'order.delivery',
        ]);
    }

    public function stepPayment()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal', 'delivery'],
            'component' => 'order.payment',
        ]);
    }

    public function stepAccept()
    {
        return view('pages.main.order', [
            'completedSteps' => ['personal', 'delivery', 'payment'],
            'component' => 'order.accept',
        ]);
    }
}
