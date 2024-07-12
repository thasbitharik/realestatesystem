<?php

namespace App\Livewire;
use App\Models\PropertyBooking;
use App\Models\SmartContract;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class BookYourProperty extends Component
{
    public $bookings = [];
    public $customerId;
    public $bookingId;
    public $bookingView = [];
    public $smartContract = [];
    public $property = "";
    public $propertyType = "";

    public function mount($id)
    {
        $this->bookingId = $id;
    }

    public function getBookings()
    {
        $this->property = Property::all();
        $this->propertyType = PropertyType::all();
        $this->smartContract = SmartContract::all();

        $this->bookingView = DB::table('properties')
                                ->select('properties.*','property_types.property_type')
                                ->leftJoin('property_types', 'properties.property_type_id','property_types.id')
                                ->where('properties.id', '=',$this->bookingId)
                                ->get();

         $customer = Auth::guard('customer')->user();
        $this->customerId = $customer->id;



    }
    public function render()
    {
        $this->getBookings();
        return view('livewire.book-your-property')->layout('layouts.front_master');
    }
}
