<?php

namespace App\Livewire;
use App\Models\Reviews;
use DB;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $list_data = DB::table('reviews')
            ->select('reviews.*', 'customers.customer_fname')
            ->leftJoin('customers', 'reviews.customer_id', 'customers.id')
            ->where('status', 1)
            ->latest()
            ->get(); 
             
        // dd($list_data);
        return view('livewire.home', ['list_data' => $list_data])->layout('layouts.front_master');
    }
}

