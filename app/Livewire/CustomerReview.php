<?php

namespace App\Livewire;

use App\Models\Customer;
use Auth;
use Livewire\Component;

class CustomerReview extends Component
{
    public $customerId;

    public function render()
    {
        if (Auth::guard('customer')->user()) {
            $customer = Auth::guard('customer')->user();
            $this->customerId = $customer->id;
            return view('livewire.customer-review')->layout('layouts.front_master');
        } else {
            return view('livewire.customer-review')->layout('layouts.front_master');
        }
    }
}
