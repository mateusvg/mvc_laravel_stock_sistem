@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <h1>Create product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="container">
        <div class="form-group">
            @csrf
            <input type="text" class="form-control mb-3" name="name" placeholder="Name" required>
            <input type="text" class="form-control mb-3" name="description" placeholder="Description" required>
            <input type="number" class="form-control mb-3" name="qty" placeholder="Quantity" required>
            <input type="number" class="form-control mb-3" name="price" placeholder="Price" required>
            <input type="file" class="form-control-file mb-3" name="img" placeholder="Image" required>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>

@endsection
