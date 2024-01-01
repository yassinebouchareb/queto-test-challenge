@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h4 class="card-title">Add Product</h4>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                    @error('quantity') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">Expiration Date</label>
                    <input type="date" class="form-control" name="expiration_date" value="{{ old('expiration_date') }}" format="yyyy-MM-dd">
                    @error('expiration_date') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create Product</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            window.location.href = "{{ route('products.create') }}";
        });
    </script>

@endsection
