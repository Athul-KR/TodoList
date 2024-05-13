@extends('layouts.menu')
@section('title','Project View')
@section('content')
<section class="">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container " style="height:100vh">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="text-end">
                    <a href="{{ route('project.list') }}" class="btn btn-info">Back</a>
                </div>
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">View Your Project</h2>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form3Example1cg">Project Title</label>
                                <input type="text" value="{{$projects->title}}" id="form3Example1cg" placeholder="Enter Project Title" name="title" class="form-control form-control-lg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection