<?php

namespace App\Livewire;
use App\Models\Property as PropertyModel;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Auth;

class SellerProperty extends Component
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
    public $new_image = [];
    public $property_type;
    public $user_id;

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
    public function fetchData()
    {
        $this->property_type = PropertyType::all();
        $this->user_id = Auth::user()->id;
    }

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
            $data->user_id = $this->user_id;
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
            $data->user_id = $this->user_id;
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
                ->where('properties.user_id', Auth::user()->id)
                ->latest()
                ->paginate(10);
        } else {
            $list_data = DB::table('properties')
                ->select('properties.*', 'property_types.property_type')
                ->leftJoin('property_types', 'properties.property_type_id', 'property_types.id')
                ->where('properties.user_id', Auth::user()->id)
                ->orWhere('properties.property_name', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.property_type_id', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.location', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('properties.price', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        $this->fetchData();
        return view('livewire.seller-property', ['list_data' => $list_data])->layout('layouts.master');
    }
}
