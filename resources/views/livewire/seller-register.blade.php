<div>
    <style>
        .padding {
            padding-bottom: 3rem !important;
        }
    </style>
    <div class="padding">

    </div>
    
    <div class="row no-gutters pt-3">
        <div class="col-lg-12">
            <div class="contact-wrap w-100 p-md-5 p-4">
                <h3 class="mb-4">Seller Register</h3>
                <form action="{{ route('sellerRegister') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="name">Mobile Number</label>
                                <input type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Mobile Number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="email">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="subject">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="subject">Confirm Password</label>
                                <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                </form>
                <h6>Already have an account?
                    <a href="/admin" class="link-danger"> Click here to Login</a>
                </h6>
            </div>
        </div>
    </div>

</div>
