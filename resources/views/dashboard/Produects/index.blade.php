@extends('layouts.app') <!-- Adjust this to your layout file -->

@section('content')
<div class="container">
    <h1>Products</h1>

    @if ($products->isEmpty())
        <div class="alert alert-warning" role="alert">
            No products found.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Compare Price</th>
                    <th>Quantity</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ number_format($product->price, 2) }} $</td>
                        <td>{{ number_format($product->compare_price, 2) }} $</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
