@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                {{-- notif alert --}}
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>
                        {{ __('Dashboard') }} | List Data Products
                    </div>
                    <div class="card-body">
                        {{-- table --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- lopping for datas --}}
                                @foreach ($products as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <img src="/images/{{ $item->image }}" height="50">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('products.show', $item->id) }}"
                                                    class="btn btn-success">Detail</a>
                                                <a href="{{ route('products.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                                <a class="btn btn-success"
                                                    href="{{ route('restore', $item->id) }}">Restore</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- pagination --}}
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
