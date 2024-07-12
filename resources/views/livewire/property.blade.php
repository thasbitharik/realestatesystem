<div>
    {{-- Success is as dangerous as failure. --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-info text-white-all">
            {{-- <li class="breadcrumb-item active"><a href="/elders-view"><i class="fa fa-arrow-left"></i> </a></li> --}}
            <li class="breadcrumb-item"><a href="/home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Properties</li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Property</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-12 col-md-4">

        </div>

        <div class="col-12 col-md-8">

            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" wire:model="searchKey" wire:keyup="fetchData"
                        placeholder="" aria-label="">
                    <div class="input-group-append">
                        <button class="btn btn-primary" wire:click="fetchData">Search</button>
                    </div>


                    <button id="formOpen" wire:click="openModel" class="btn btn-info ml-1"><i class="fa fa-plus"
                            aria-hidden="true"></i> Create-New
                    </button>


                </div>
            </div>
        </div>


    </div>




    <div class="row">

        <div class="col-12 col-md-12">
            <div class="card">
                <div class="p-4">
                    <h4>Property Type</h4>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Property Type</th>
                                <th>Property Name</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @php($x = 1)
                            @foreach ($list_data as $row)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td><img alt="image" src="{{ Storage::url($row->image) }}" width="150px"
                                            height="150px "></td>
                                    <td>{{ $row->property_type }}</td>
                                    <td>{{ $row->property_name }}</td>
                                    <td>{{ $row->location }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>
                                        @if ($row->status == 0)
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                                Pending
                                            </button>
                                        @elseif($row->status == 1)
                                            <button class="btn btn-sm btn-success"
                                                wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                                Available
                                            </button>
                                        @elseif ($row->status == 2)
                                            <button class="btn btn-sm btn-warning"
                                                wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                                Booked
                                            </button>
                                            @elseif ($row->status == 3)
                                            <button class="btn btn-sm btn-Danger"
                                                wire:click="statusChangeModel('{{ $row->id }}','{{ $row->status }}')">
                                                Sold
                                            </button>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="#" class="text-danger m-2"
                                            wire:click="deleteOpenModel({{ $row->id }})"><i class="fa fa-trash"
                                                aria-hidden="true"></i>
                                        </a>



                                        <a href="#" class="text-info"
                                            wire:click="updateRecord({{ $row->id }})"><i class="fa fa-pen"
                                                aria-hidden="true"></i>
                                        </a>




                                    </td>
                                </tr>
                                @php($x++)
                            @endforeach

                        </table>
                    </div>

                </div>

            </div>
        </div>


        {{-- Insert model here --}}
        <div wire:ignore.self class="modal fade" id="insert-model" tabindex="-1" role="dialog"
            aria-labelledby="formModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                                <div class="form-group" wire:model="new_property_type">
                                    <label>Property Type</label>
                                    <select class="form-control">
                                        <option value="" selected>-- Select Property Type-- </option>
                                        @foreach ($property_type as $type)
                                            <option value="{{ $type->id }}">
                                                {{ $type->property_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('new_property_type')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Property Name</label>
                                    <input type="text" class="form-control" placeholder="Property Name"
                                        required="" wire:model="new_property">
                                    @error('new_property')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" placeholder="Location"
                                        wire:model="new_location">
                                    @error('new_location')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" placeholder="Price"
                                        wire:model="new_price">
                                    @error('new_price')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" wire:model="new_description" cols="60" rows="40"></textarea>
                                        @error('new_description')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 ">
                                    <div class="form-group">
                                        <label>Images</label>
                                        <input type="file" class="form-control" wire:model="new_image"
                                            placeholder="Images">
                                        @error('new_image')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>



                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="text-right">
                            <button type="button" wire:click="closeModel"
                                class="btn btn-danger m-t-15 waves-effect">Close </button>
                            <button type="button" wire:click="saveData"
                                class="btn btn-primary m-t-15 waves-effect">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- model end --}}

        <div wire:ignore.self class="modal fade" id="status-model" tabindex="-1" role="dialog"
            aria-labelledby="formModal" aria-hidden="true">
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
                                    <option value="1">Available</option>
                                    <option value="2">Booked</option>
                                    <option value="3">Sold</option>


                                </select>
                                @error('status')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" wire:click="closeStatusChangeModel"
                                class="btn btn-success m-t-15 waves-effect">No </button>
                            <button type="button" wire:click="saveStatusChangeModel"
                                class="btn btn-danger m-t-15 waves-effect">Yes</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- delete model here --}}
        <div wire:ignore.self class="modal fade" id="delete-model" tabindex="-1" role="dialog"
            aria-labelledby="formModal" aria-hidden="true">
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
                            <button type="button" wire:click="deleteCloseModel"
                                class="btn btn-success m-t-15 waves-effect">No </button>
                            <button type="button" wire:click="deleteRecord"
                                class="btn btn-danger m-t-15 waves-effect">Yes</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- model end --}}

    </div>




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
