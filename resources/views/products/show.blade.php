@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('products.index') }}" class="btn btn-success">View</a>
                        {{ __('Dashboard') }} | Detail Produk
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        {{-- card product detail --}}
                        <div class="card" style="width: 18rem;">
                            <img src="/images/{{ $product->image }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">$. {{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
