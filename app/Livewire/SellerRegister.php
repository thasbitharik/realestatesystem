<?php

namespace App\Livewire;

use Livewire\Component;

class SellerRegister extends Component
{
    public function render()
    {
        return view('livewire.seller-register')->layout('layouts.front_master');
    }
}
