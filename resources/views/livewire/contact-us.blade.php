<div>
    <style>
        .padding {
            padding-bottom: 3rem !important;
        }
    </style>
    <div class="padding">

    </div>
    <div class="row no-gutters">
        <div class="col-lg-12">
            <div class="contact-wrap w-100 p-md-5 p-4">
                <h3 class="mb-4">Review</h3>
                <form action="/ContactUs" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label class="label" for="name">Customer ID</label>
                                <input type="number" class="form-control @error('customer_id') is-invalid @enderror"
                                    name="customer_id" value="{{ $customerId }}" id="customer_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="name">Name</label>
                                @if (Auth::guard('customer')->check())
                                    <input type="text" name="name" class="form-control" value="{{ $customerName }}">
                                @else
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="message">Message</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>
