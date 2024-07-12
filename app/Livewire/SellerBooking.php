<?php

namespace App\Livewire;
use App\Models\PropertyBooking;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Auth;

class SellerBooking extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $message = "";
    public $property = "";
    public $user_id = "";


    public function fetchData()
    {
        $this->property = Property::all();
    }

    public function render()
    {
        $this->user_id = Auth::user()->id;
        if (!$this->searchKey) {
            $list_data = DB::table('property_bookings')
                ->select('property_bookings.*', 'properties.property_name', 'customers.customer_fname')
                ->leftJoin('properties', 'property_bookings.property_id', 'properties.id')
                ->leftJoin('customers', 'property_bookings.customer_id', 'customers.id')
                ->where('property_bookings.user_id', '=', $this->user_id)
                ->latest()
                ->paginate(10);
        }
        else {
            $list_data = DB::table('property_bookings')
                ->select('property_bookings.*', 'properties.property_name', 'customers.customer_fname')
                ->leftJoin('properties', 'property_bookings.property_id', 'properties.id')
                ->leftJoin('customers', 'property_bookings.customer_id', 'customers.id')
                ->where('property_bookings.user_id', '=', $this->user_id)
                ->when($this->searchKey, function ($query) { 
                    return $query->where(function ($query) {
                        $query->where('property_bookings.contract_plan', 'LIKE', '%' . $this->searchKey . '%')
                              ->orWhere('properties.property_name', 'LIKE', '%' . $this->searchKey . '%')
                              ->orWhere('customers.customer_fname', 'LIKE', '%' . $this->searchKey . '%');
                    });
                })
                ->latest()
                ->paginate(10);
        }
        // dd($list_data);
        $this->fetchData();
        return view('livewire.seller-booking', ['list_data' => $list_data])->layout('layouts.master');
    }
}
