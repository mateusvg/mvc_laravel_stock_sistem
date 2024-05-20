@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <h1>Edit product</h1>

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data"
        class="container">
        @csrf
        @method('PUT')
        <div class="form-group">
            ID: <input type="text" class="form-control mb-3" value="{{ $product->id }}" name="id" placeholder="Name"
                disabled>
            Name:: <input type="text" class="form-control mb-3" value="{{ $product->name }}" name="name"
                placeholder="Nome" required>
            Description: <input type="text" class="form-control mb-3" value="{{ $product->description }}"
                name="description" placeholder="Description" required>
            Quantity: <input type="number" class="form-control mb-3" value="{{ $product->qty }}" name="qty"
                placeholder="Quantity" required>
            <input type="file" class="form-control-file mb-3" name="img" placeholder="Imagem" required>
        </div>
        <button type="submit" class="btn btn-primary">Update product</button>
    </form>


@endsection
