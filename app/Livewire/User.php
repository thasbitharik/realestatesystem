<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class User extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchKey;
    public $key = 0;
    public $message = "";

    public $new_user_name;
    public $new_user_tp;
    public $new_user_email;
    public $new_confirm_password;
    public $new_user_password;
    public $new_user_roles;
    public $status;
    public $selected_id;

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
            $data = UserModel::find($this->delete_id);
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
        $data = UserModel::find($this->selected_id);
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

    // insert and update data here
    public function saveData()
    {
        //validate data
        $this->validate(
            [
                'new_user_name' => 'required|max:255',
                'new_user_tp' => 'required|max:12',
                'new_user_email' => 'required|email|max:45|unique:users,email',
                'new_user_roles' => 'required',
                'new_user_password' => 'required|min:6',
                'new_confirm_password' => 'required_with:new_user_password|same:new_user_password|min:6'


            ]
        );

        //check id value and execute
        if ($this->key == 0) {
            //here insert data
            $data = new UserModel();
            $data->name = $this->new_user_name;
            $data->tp = $this->new_user_tp;
            $data->email = $this->new_user_email;
            $data->roles = $this->new_user_roles;
            $data->password = Hash::make($this->new_user_password);
            $data->save();

            //show success message
            session()->flash('message', 'Saved Successfully!');

            //clear data
            $this->clearData();
            $this->closeModel();
        } else {
            //here update data
            $data = UserModel::find($this->key);
            $data->name = $this->new_user_name;
            $data->tp = $this->new_user_tp;
            $data->email = $this->new_user_email;
            $data->roles = $this->new_user_roles;
            $data->password = Hash::make($this->new_user_password);
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
        $data = UserModel::find($id);
        $this->new_user_name =  $data->name;
        $this->new_user_tp = $data->tp;
        $this->new_user_email = $data->email;
        $this->new_user_roles = $data->roles;
        $this->key = $id;
    }

    //clear data
    public function clearData()
    {
        # emty field
        $this->key = 0;
        $this->new_user_roles = "";

    }
    public function render()
    {
        $this->fetchData();
        #if search active
        if (!$this->searchKey) {
            $list_data = DB::table('users')
                ->select('users.*')
                ->latest()
                ->paginate(10);

        } else {
            $list_data = DB::table('users')
                ->select('users.*')
                ->where('users.name', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('users.tp', 'LIKE', '%' . $this->searchKey . '%')
                ->orWhere('users.email', 'LIKE', '%' . $this->searchKey . '%')
                ->latest()
                ->paginate(10);
        }
        return view('livewire.user',['list_data'=>$list_data])->layout('layouts.master');
    }
}
