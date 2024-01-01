@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-header mb-5">
                <h4 class="card-title">Edit Product : {{ $product->name }}</h4>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                    @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                    @error('quantity') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">Expiration Date</label>
                    <input type="date" class="form-control" name="expiration_date" value="{{ $product->expiration_date->format('Y-m-d') }}">
                    @error('expiration_date') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update Product</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            window.location.href = "{{ route('products.create') }}";
        });
    </script>

@endsection
