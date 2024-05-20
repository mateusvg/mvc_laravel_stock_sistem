@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <h1>Product - all</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        @foreach ($products as $product)
            <tbody>
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->qty }}</td>
                    <td><img src="/img/products/{{ $product->img }} " style="max-width: 20px; max-height: 20px;"></td>
                    <td>
                        <a href="{{ route('products.edit', ['id' => $product->id]) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
@endsection
