<div>
    <style>
        .padding {
            padding-bottom: 4rem !important;
        }
    </style>
    <div class="padding"></div>
    <section class="section-padding30">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 p-3 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="/customer-login">
                        @csrf
                        <!-- Email input -->
                        <div class="card shadow-2-strong login-card" style="margin-top: 100px">
                            <h3 class="text-center">LOGIN</h3>
                            <div class="form-outline mb-4" style="margin:10px">
                                <input type="email" id="email" class="form-control form-control-lg @error('customer_email')
                            is-invalid @enderror" name="customer_email" value="{{old('customer_email')}}" placeholder="Enter Email address" required autocomplete="email" autofocus />
                                {{-- <label class="form-label" for="form3Example3">Email address</label> --}}
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3" style="margin:10px;">
                                <input type="password" id="password" class="form-control form-control-lg @error('password')
                            is-invalid @enderror" name="password" placeholder="Enter password" required autocomplete="current-password" />
                                <i class="bi bi-eye-slash" id="togglePassword" onclick="myFunction();" style="float:right; margin-top:-35px; margin-right:18px;cursor: pointer;"></i>
                                {{-- <label class="form-label" for="form3Example4">Password</label> --}}
                            </div>
                            <div class="text-center text-white text-lg-start mt-3 " style="margin-right: 10px; margin-left:10px; margin-bottom:20px;">
                                <center>
                                    <button type="submit" class="btn btn-lg btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                        Login </button>
                                </center>
                                <br>

                                <h6 class="text-center">Don't have an account?
                                    <a href="/customer-register" class="clicktoregister"> Click here to Register</a>
                                </h6>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
