<?php

namespace App\Livewire;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;
use Auth;
use Livewire\Component;

class PropertyBooking extends Component
{
    public $property = "";
    public $propertyType = "";
    public $list_data = [];

    public function fetchData()
    {
        $this->property = Property::all();
        $this->propertyType = PropertyType::all();

        $this->list_data = DB::table('properties')
                   ->select('properties.*','property_types.property_type')
                   ->leftJoin('property_types', 'properties.property_type_id','property_types.id')
                    ->where('status',1)
                   ->get();
    }
    public function render()
    {
        $this->fetchData();
        return view('livewire.property-booking')->layout('layouts.front_master');
    }
}
