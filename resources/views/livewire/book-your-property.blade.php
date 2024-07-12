<div>
    <div>
        <div class="row"></div>
    </div>
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-5 d-flex">
                    <img alt="image" src="{{ Storage::url($bookingView[0]->image) }}" class="block-20 rounded" style="width: 500px; height:400px; object-fit:cover; margin-top:100px;">
    			</div>
    			<div class="col-md-7 pl-md-5 py-md-5">
    				<div class="heading-section pt-md-5">
	            <h2 class="mb-4">{{ $bookingView[0]->property_name }}</h2>
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="text pl-3">
	    						<h4>{{ $bookingView[0]->property_type }}</h4>
	    					</div>
	    				</div>
                        <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="text pl-3">
	    						<h4>{{ $bookingView[0]->price }}</h4>
	    					</div>
	    				</div>
                        <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="text pl-3">
	    						<h4>{{ $bookingView[0]->location }}</h4>
	    					</div>
	    				</div>
                        <div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="text pl-3">
	    						<h4>{{ $bookingView[0]->description }}</h4>
	    					</div>
	    				</div>
	    			</div>
	        </div>
        </div>
    	</div>
    </section>
    <div class="row no-gutters">
        <div class="col-lg-12">
            <div class="contact-wrap w-100 p-md-5 p-4">
                <h3 class="mb-4">Book Your Property</h3>
                <form action="/bookYourProperty" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label class="label" for="name">Property ID</label>
                                <input type="number" class="form-control @error('property_id') is-invalid @enderror" name="property_id" value="{{ $bookingView[0]->id }}"  id="property_id" >
                            </div>
                            <div class="form-group">
                                <label class="label" for="name">User ID</label>
                                <input type="number" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ $bookingView[0]->user_id }}"  id="user_id" >
                            </div>
                            <div class="form-group">
                                <label class="label" for="name">Customer ID</label>
                                <input type="number" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" value="{{ $customerId }}"  id="customer_id" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="name">Booking Date</label>
                                <input type="date" class="form-control  @error('booking_date') is-invalid @enderror" name="booking_date"  id="booking_date"  >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Smart Contract</label>
                                <select class="form-control" name="contract_plan">
                                    <option value="">-- Select Contract Plan-- </option>
                                    @foreach ( $smartContract as $smart)
                                    <option value="{{ $smart->id }}">
                                        {{ $smart->contract_period . "and" . "" . "" . $smart->Price}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('contract_plan')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" >Book</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
