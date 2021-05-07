<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function stepPersonal()
    {
        return view('pages.main.order', [
            'completedSteps' => [],
            'component' => 'order.personal',
        ]);
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
