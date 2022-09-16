@extends('layouts.frontend')

@section('content')
    <h1 class="text-center mt-5">About Page</h1>
    <div class="row">
        <div class="col-md-3 mx-auto">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/images/' . $image) }}" class="card-img-top" alt="logo">
                <div class="card-body">
                    <h5 class="card-title">{{ $nama }}</h5>
                    <p class="card-text">{{ $alamat }}</p>
                    <small>{{ $job }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
