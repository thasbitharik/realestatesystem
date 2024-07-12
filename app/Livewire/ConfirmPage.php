<?php

namespace App\Livewire;
use App\Models\PropertyBooking;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConfirmPage extends Component
{
    public $booking = [];

    public function confirmBooking()
    {
        $this->booking = PropertyBooking::all();

    }
    public function render()
    {
        $this->confirmBooking();
        return view('livewire.confirm-page')->layout('layouts.front_master');
    }
}
