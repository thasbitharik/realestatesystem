<?php

namespace App\Livewire;

use App\Models\Property as PropertyModel;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Auth;

class Property extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $message = "";

    public $new_property = "";
    public $new_property_type = "";
    public $new_location = "";
    public $new_price = "";
    public $new_description = "";
    public $status;
    public $selected_id;
    public $new_image = [];
    public $property_type;

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
            $data = PropertyModel::find($this->delete_id);
            $data->delete();
            $this->deleteCloseModel();
        }
    }
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
        $data = PropertyModel::find($this->selected_id);
        $data->status = (int)$this->status;
        $data->save();
        $this->statusClear();
    }

    public function statusClear()
    {
        $this->selected_id = null;
        $this->closeStatusChangeModel();
    }
    //fetch data from db
    public function fetchData()
    {
        $this->property_type = PropertyType::all();
    }

    // insert and update data here
    public function saveData()
    {
        //validate data
        $this->validate(
            [
                'new_property' => 'required',
                'new_property_type' => 'required',
                'new_location' => 'required',
                'new_description' => 'required',
                'new_price' => 'required',
                'new_image' => 'required',


            ]
        );

        //check id value and execute
        if ($this->key == 0) {
            //here insert data
            $data = new PropertyModel();
            $data->property_type_id = $this->new_property_type;
            $data->property_name = $this->new_property;
            $data->location = $this->new_location;
            $data->price = $this->new_price;
            $data->description = $this->new_description;
            $data->user_id = Auth::user()->id;
            if (is_array($this->new_image) && !empty($this->new_image)) {
                foreach ($this->new_image as $image) {
                    if (!empty($image)) {
                        $imageUpload = $image->store('photos', 'public');
                        $data->image = $imageUpload;
                        break;
                    }
                }
            }
            $data->save();

            //show success message
            session()->flash('message', 'Saved Successfully!');

            //clear data
            $this->clearData();
            $this->closeModel();
        } else {
            $this->validate(
                [
                    'new_property' => 'required',
                    'new_property_type' => 'required',
                    'new_location' => 'required',
                    'new_description' => 'required',
                    'new_price' => 'required',
                    'new_image' => 'required',


                ]
            );
            //here update data
            $data = PropertyModel::find($this->key);
            $data->property_type_id = $this->new_property_type;
            $data->property_name = $this->new_property;
            $data->location = $this->new_location;
            $data->price = $this->new_price;
            $data->description = $this->new_description;
            if (is_array($this->new_image) && !empty($this->new_image)) {
                foreach ($this->new_image as $image) {
                    if (!empty($image)) {
                        $imageUpload = $image->store('photos', 'public');
                        $data->image = $imageUpload;
                        break;
                    }
                }
            }

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
        $data = PropertyModel::find($id);
        $this->new_property_type = $data->property_type_id;
        $this->new_property = $data->property_name;
        $this->new_location = $data->location;
        $this->new_price = $data->price;
        $this->new_description = $data->description;
        $this->new_image = $data->image;
        $this->key = $id;
    }

    //clear data
    public function clearData()
    {
        # emty field
        $this->key = 0;
        $this->new_property_type = "";
        $this->new_property = "";
        $this->new_location = "";
        $this->new_price = "";
        $this->new_description = "";
        $this->new_image = "";
    }

    public function render()
    {
        if (!$this->searchKey) {
            $list_data = DB::table('properties')
                ->select('properties.*', 'property_types.property_type')
                ->leftJoin('property_types', 'properties.property_type_id', 'property_types.id')
                ->latest()
                ->paginate(10);
        } else {
            $list_data = DB::table('properties')
                ->select('properties.*', 'property_types.property_type')
                ->leftJoin('property_types', 'properties.property_type_id', 'property_types.id')
                ->where('properties.property_name', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.property_type_id', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.location', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.price', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        $this->fetchData();
        return view('livewire.property', ['list_data' => $list_data])->layout('layouts.master');
    }
}
