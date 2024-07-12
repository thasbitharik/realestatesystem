<?php

namespace App\Livewire;

use App\Models\Customer;
use Auth;
use Livewire\Component;

class ContactUs extends Component
{
    public $customerId;
    public $customerName;
    public function render()
    {
        if (Auth::guard('customer')->user()) {
            $customer = Auth::guard('customer')->user();
            $this->customerId = $customer->id;
            $this->customerName = $customer->customer_fname;
            return view('livewire.contact-us')->layout('layouts.front_master');
        } else {
            return view('livewire.contact-us')->layout('layouts.front_master');
        }
    }
}
