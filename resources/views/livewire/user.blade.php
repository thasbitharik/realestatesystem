<div>
    {{-- Success is as dangerous as failure. --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-info text-white-all">
            {{-- <li class="breadcrumb-item active"><a href="/elders-view"><i class="fa fa-arrow-left"></i> </a></li> --}}
            <li class="breadcrumb-item"><a href="/home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> User</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-12 col-md-4">

        </div>

        <div class="col-12 col-md-8">

            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" wire:model="searchKey" wire:keyup="fetchData" placeholder="" aria-label="">
                    <div class="input-group-append">
                        <button class="btn btn-primary" wire:click="fetchData">Search</button>
                    </div>
                    <button id="formOpen" wire:click="openModel" class="btn btn-info ml-1"><i class="fa fa-plus" aria-hidden="true"></i> Create New</button>
                </div>
            </div>
        </div>


    </div>




    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="p-4">
                    <h4>User(s)</h4>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Tp</th>
                                <th>Email</th>
                                <th>User-Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @php($x = 1)
                            @foreach ($list_data as $row)
                            <tr>
                                <td>{{ $list_data->firstItem() + $loop->iteration - 1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->tp }}</td>
                                <td>{{ $row->email }}</td>
                                @if ($row->roles == 0)
                                <td>Super Admin</td>
                                @elseif ($row->roles == 1)
                                <td>Admin</td>
                                @elseif ($row->roles == 2)
                                <td>Seller</td>
                                @endif
                                @if($row->roles == 2)

                                <td>
                                    @if ($row->status == 0)
                                    <button class="btn btn-sm btn-danger" wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                        Pending
                                    </button>
                                    @elseif($row->status == 1)
                                    <button class="btn btn-sm btn-success" wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                        Accepted
                                    </button>
                                    @endif
                                </td>
                                @else
                                <td>No Status</td>
                                @endif

                                <td>

                                    <a href="#" class="text-danger m-2" wire:click="deleteOpenModel({{ $row->id }})"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>

                                    <a href="#" class="text-info" wire:click="updateRecord({{ $row->id }})"><i class="fa fa-pen" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-6 ml-2">
                                Showing {{ $list_data->firstItem() }} - {{ $list_data->lastItem() }} of
                                {{ $list_data->total() }}
                            </div>
                        </div>
                        <div class="float-right mr-3">
                            {{ $list_data->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="status-model" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="formModal">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="0">Pending</option>
                                <option value="1">Accepted</option>


                            </select>
                            @error('status')
                            <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" wire:click="closeStatusChangeModel" class="btn btn-success m-t-15 waves-effect">No </button>
                        <button type="button" wire:click="saveStatusChangeModel" class="btn btn-danger m-t-15 waves-effect">Yes</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Insert model here --}}
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="insert-model" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Create Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" required="" wire:model="new_user_name">
                                @error('new_user_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tp</label>
                                <input type="text" class="form-control" placeholder="Tp" required="" wire:model="new_user_tp">
                                @error('new_user_tp')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group" wire:model="new_user_type">
                                <label>User-Type</label>
                                <select class="form-control">
                                    <option value="">-- Select User Type-- </option>
                                    <option value="0">Super Admin </option>
                                    <option value="1">Admin </option>
                                    <option value="2">Seller </option>
                                </select>
                                @error('new_user_type')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" required="" wire:model="new_user_email">
                                @error('new_user_email')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="Password" class="form-control" required="" wire:model="new_user_password">
                                @error('new_user_password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Conform-Password</label>
                                <input type="Password" class="form-control" required="" wire:model="new_confirm_password">
                                @error('new_confirm_password')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    <div class="text-right">
                        <button type="button" wire:click="closeModel" class="btn btn-danger m-t-15 waves-effect">Close
                        </button>
                        <button type="button" wire:click="saveData" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- model end --}}



    {{-- delete model here --}}
    <div wire:ignore.self class="modal fade" id="delete-model" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="formModal">Warning!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        If you want to remove this data, <b>you can't undone</b>, It will be affected that relevent
                        records!
                    </p>

                    <div class="text-right">
                        <button type="button" wire:click="deleteCloseModel" class="btn btn-success m-t-15 waves-effect">No </button>
                        <button type="button" wire:click="deleteRecord" class="btn btn-danger m-t-15 waves-effect">Yes</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- model end --}}


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#formOpen").click(function() {
            $("#div3").fadeIn(500);
        });

        $("#formClose").click(function() {
            $("#div3").fadeOut();
        });
    });

</script>
