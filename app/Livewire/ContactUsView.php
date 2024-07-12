<?php

namespace App\Livewire;
use App\Models\ContactUs;
use Livewire\Component;
use DB;
class ContactUsView extends Component
{
    public $searchKey;
    public $key = 0;
    public $message = "";

    public function fetchData()
    {

    }
    public function render()
    {
        if (!$this->searchKey) {
            $list_data = DB::table('contact_us')
                ->select('contact_us.*', 'customers.customer_fname')
                ->leftJoin('customers', 'contact_us.customer_id', 'customers.id')
                ->latest()
                ->paginate(10);
        } else {
            $list_data = DB::table('contact_us')
                ->select('contact_us.*', 'customers.customer_fname')
                ->leftJoin('customers', 'contact_us.customer_id', 'customers.id')
                ->where('contact_us.name', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('contact_us.email', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('customers.customer_fname', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        $this->fetchData();
        return view('livewire.contact-us-view',['list_data' => $list_data])->layout('layouts.master');
    }
}
