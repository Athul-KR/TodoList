@extends('layouts.menu')
@section('title','Login')
@section('content')
<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                @if(session()->has('message'))<p class="text-center text-dark border
                border-dark  mb-3" id="message">{{session()->get('message')}}</p>
                <script>
                    setTimeout(function() {
                        $('#message').fadeOut('fast');
                    }, 3000); // 3 seconds
                </script>
                @endif
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login to your account</h2>
                            <form method="post" action="{{route('user.dologin')}}">
                                @csrf
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
                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="submit" data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-3 text-body">Login</button>
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="{{route('user.create')}}" class="fw-bold text-body"><u>Signup here</u></a>
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