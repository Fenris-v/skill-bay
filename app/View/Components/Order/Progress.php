<?php

namespace App\View\Components\Order;

use Illuminate\View\Component;

class Progress extends Component
{
    public array $steps;

    public function __construct(array $completedSteps = [])
    {
        $this->steps = [
            [
                'title' => __('orderPage.steps.personal'),
                'url' => route('order.personal.get'),
                'isCompleted' => in_array('personal', $completedSteps),
            ],
            [
                'title' => __('orderPage.steps.delivery'),
                'url' => route('order.delivery.get'),
                'isCompleted' => in_array('delivery', $completedSteps),
            ],
            [
                'title' => __('orderPage.steps.payment'),
                'url' => route('order.payment.get'),
                'isCompleted' => in_array('payment', $completedSteps),
            ],
            [
                'title' => __('orderPage.steps.accept'),
                'url' => route('order.accept.get'),
                'isCompleted' => in_array('accept', $completedSteps),
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order.progress');
    }
}
