<?php

namespace App\Livewire;
use App\Models\PropertyBooking;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;

class Bookings extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $message = "";
    public $property = "";
    public $status;
    public $selected_id;

    public function openStatusChangeModel()
    {
        $this->dispatch('status-show-form');
    }

    public function statusChangeModel($id, $status)
    {
        $this->selected_id = $id;
        $this->status = $status;
        $this->openStatusChangeModel();
    }

    public function closeStatusChangeModel()
    {
        $this->dispatch('status-hide-form');
    }

    public function saveStatusChangeModel()
    {
        $data = PropertyBooking::find($this->selected_id);
        $data->status = (int)$this->status;
        $data->save();
        $this->statusClear();
    }

    public function statusClear()
    {
        $this->selected_id = null;
        $this->closeStatusChangeModel();
    }

    public function fetchData()
    {
        $this->property = Property::all();
    }
    public function render()
    {
        if (!$this->searchKey) {
            $list_data = DB::table('property_bookings')
                ->select('property_bookings.*', 'properties.property_name', 'customers.customer_fname')
                ->leftJoin('properties', 'property_bookings.property_id', 'properties.id')
                ->leftJoin('customers', 'property_bookings.customer_id', 'customers.id')
                ->latest()
                ->paginate(10);
        } 
        else {
            $list_data = DB::table('property_bookings')
                ->select('property_bookings.*', 'properties.property_name', 'customers.customer_fname')
                ->leftJoin('properties', 'property_bookings.property_id', 'properties.id')
                ->leftJoin('customers', 'property_bookings.customer_id', 'customers.id')
                ->where('property_bookings.contract_plan', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.property_name', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('customers.customer_fname', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        // dd($list_data);
        $this->fetchData();
        return view('livewire.bookings', ['list_data' => $list_data])->layout('layouts.master');
    }
}
