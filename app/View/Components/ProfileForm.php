<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileForm extends Component
{
	public $name;
	public $phone;
	public $email;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $email)
    {
		$this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile-form');
    }
}
