@extends('layouts.main')

@section('title', 'Sell')

@section('content')
    <style>
        /* Custom CSS for setting max-width */
        .max-table {
            max-width: 800px;
            /* Set your desired maximum width */
            margin: auto;
            padding-top: 5%;
            /* Center the table horizontally */
        }

        .scrollable-container {
            max-height: 300px;
            /* Set your desired maximum height */
            overflow-y: auto;
            margin-top: 5%;
            /* Enable vertical scrolling */
        }
    </style>

    <h1>Point of Sale</h1>
    <form action='/sell' method='GET'>
        <input type='text' name='search' placeholder='Search products' class='form-control'>
    </form>
    <div class="scrollable-container">
        <table class="table max-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($cartItem)
                @foreach ($cartItem as $item)
                    <span>{{ $item }}</span>
                    <!-- Display other item details as needed -->
                @endforeach
            @endif

            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->qty }}</td>
                            <td><img src="/img/products/{{ $product->img }}" style="max-width: 20px; max-height: 20px;">
                            </td>
                            <td>
                                <form action="{{ route('sell.add', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="POST">
                                    <button type="submit" class="btn btn-outline-danger">Add to cart</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            @else
                <p>No products found.</p>
            @endif
        </table>
    </div>

    <table id="cart" class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @php $total = 0 @endphp
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    <tr rowId="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" class="card-img-top" />
                                </div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>

                        <td data-th="Subtotal" class="text-center"></td>
                        <td class="actions">
                            <a class="btn btn-outline-danger btn-sm delete-product"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue
                        Shopping</a>
                    <button class="btn btn-danger">Checkout</button>
                </td>
            </tr>
        </tfoot>
    </table>

    <script type="text/javascript">
        $(".edit-cart-info").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('sell.add') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId"),
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".delete-product").click(function(e) {
            console.log('Delete')
            e.preventDefault();
            var ele = $(this);


            $.ajax({
                url: '{{ route('sell.delete') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function(response) {
                    window.location.reload();
                }
            });

        });
    </script>
@endsection
