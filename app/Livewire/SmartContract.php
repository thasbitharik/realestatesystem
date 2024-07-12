<?php

namespace App\Livewire;
use App\Models\SmartContract as SmartContractModel;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;

class SmartContract extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $contract_period;
    public $price;

    public function openModel()
    {
        $this->dispatch('insert-show-form');
    }

    //close model insert
    public function closeModel()
    {
        $this->dispatch('insert-hide-form');
    }

    //open model delete
    public $delete_id = 0;
    public function deleteOpenModel($id)
    {
        $this->delete_id = $id;
        $this->dispatch('delete-show-form');
    }

    //close model close
    public function deleteCloseModel()
    {
        $this->dispatch('delete-hide-form');
    }

    public function deleteRecord()
    {
        # code...
        if ($this->delete_id != 0) {
            $data = SmartContractModel::find($this->delete_id);
            $data->delete();
            $this->deleteCloseModel();
        }
    }

    public function fetchData()
    {

    }

    public function saveData()
    {
        if ($this->key == 0) {
            $data = new SmartContractModel();
            $data->contract_period = $this->contract_period;
            $data->Price = $this->price;
            $data->save();
            session()->flash('message', 'Saved Successfully!');

            //clear data
            $this->clearData();
            $this->closeModel();
        } else {
            $data = SmartContractModel::find($this->key);
            $data->contract_period = $this->contract_period;
            $data->Price = $this->price;
            $data->save();
            session()->flash('message', 'Saved Successfully!');

            //clear data
            $this->clearData();
            $this->closeModel();
        }
    }

    public function updateRecord($id)
    {
        $this->openModel();
        $data = SmartContractModel::find($id);
        $this->contract_period = $data->contract_period;
        $this->price = $data->Price;
        $this->key = $id;
    }

    public function clearData()
    {
        $this->contract_period = "";
        $this->price = "";
        $this->key = 0;
    }
    public function render()
    {
        if (!$this->searchKey) {
            $list_data = DB::table('smart_contracts')
                            ->select('smart_contracts.*')
                            ->latest()
                            ->paginate(10);
        } else {
            $list_data = DB::table('smart_contracts')
                            ->select('smart_contracts.*')
                            ->where('smart_contracts', 'LIKE', '%'.$this->searchKey,'%')
                            ->latest()
                            ->paginate(10);
        }

        return view('livewire.smart-contract',['list_data' => $list_data])->layout('layouts.master');
    }
}
