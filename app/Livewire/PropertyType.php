<?php

namespace App\Livewire;

use App\Models\PropertyType as PropertyTypeModel;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;

class PropertyType extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $message = "";

    public $new_property_type = "";

    //open model insert
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
            $data = PropertyTypeModel::find($this->delete_id);
            $data->delete();
            $this->deleteCloseModel();
        }

    }

    //fetch data from db
    public function fetchData()
    {
    }

    // insert and update data here
    public function saveData()
    {
        //validate data
        $this->validate(
            [
                'new_property_type' => 'required|max:255'

            ]
        );

        //check id value and execute
        if ($this->key == 0) {
            //here insert data
            $data = new PropertyTypeModel();
            $data->property_type = $this->new_property_type;
            $data->save();

            //show success message
            session()->flash('message', 'Saved Successfully!');

            //clear data
            $this->clearData();
            $this->closeModel();
        } else {
            $this->validate(
                [
                    'new_property_type' => 'required|max:255'


                ]
            );
            //here update data
            $data = PropertyTypeModel::find($this->key);
            $data->property_type = $this->new_property_type;
            $data->save();

            //show success message
            session()->flash('message', ' Update Successfuly!');

            //clear data
            $this->clearData();
            $this->closeModel();
        }
    }

    //fill box forupdate
    public function updateRecord($id)
    {
        # code...
        $this->openModel();
        $data = PropertyTypeModel::find($id);
        $this->new_property_type = $data->property_type;
        $this->key = $id;
    }

    //clear data
    public function clearData()
    {
        # emty field
        $this->key = 0;
        $this->new_property_type = "";
    }


    public function render()
    {
        $this->fetchData();
        #if search active
        if (!$this->searchKey) {
            $list_data = DB::table('property_types')
                ->select('property_types.*')
                ->latest()
                ->paginate(10);
        } else {
            $list_data = DB::table('property_types')
                ->select('property_types.*')
                ->where('property_types.property_type', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        return view('livewire.property-type', ['list_data' => $list_data])->layout('layouts.master');
    }
}
