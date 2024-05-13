@extends('layouts.menu')
@section('title','Create')
@section('content')
<section class=" bg-image img-fluid " style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 my-3">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form method="post" action="{{route('user.save')}}">
                                @csrf

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Your Name</label>
                                    <input type="text" id="form3Example1cg" placeholder="Enter Name" name="name" class="form-control form-control-lg" />
                                    @error('name')
                                    <p class=" text-danger form-group">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Your Phone</label>
                                    <input type="text" id="form3Example3cg" placeholder="Enter Phone Number" name="phone" class="form-control form-control-lg" />
                                    @error('phone')
                                    <p class=" text-danger form-group">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    <input type="password" id="form3Example4cg" placeholder="Enter Password" name="password" class="form-control form-control-lg" />
                                    @error('password')
                                    <p class=" text-danger form-group">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div data-mdb-input-init class=" form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    <input type="password" name="password_confirmation" placeholder="Repeat Password" id="form3Example4cdg" class="form-control form-control-lg" />
                                    @error('password_confirmation')
                                    <p class=" text-danger form-group">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="submit" data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-3 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{route('user.login')}}" class="fw-bold text-body"><u>Login here</u></a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection