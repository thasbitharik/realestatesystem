<?php

namespace App\Livewire;

use App\Models\Reviews as ReviewModel;
use App\Models\Customer;
use Livewire\Component;
use Auth;
use DB;
class Reviews extends Component
{
    public $searchKey;
    public $key = 0;
    public $message = "";
    public $Customer = "";
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
        $data = ReviewModel::find($this->selected_id);
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
    }
    public function render()
    {
        if (!$this->searchKey) {
            $list_data = DB::table('reviews')
                ->select('reviews.*', 'customers.customer_fname')
                ->leftJoin('customers', 'reviews.customer_id', 'customers.id')
                ->latest()
                ->paginate(10);
        } else {
            $list_data = DB::table('reviews')
                ->select('reviews.*', 'customers.customer_fname')
                ->leftJoin('customers', 'reviews.customer_id', 'customers.id')
                ->where('reviews.rating', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('customers.customer_fname', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        $this->fetchData();
        return view('livewire.reviews',['list_data'=> $list_data])->layout('layouts.master');
    }
}
