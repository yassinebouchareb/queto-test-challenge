@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="card-header mb-3">
                <h5 class="card-title">Add Recipe</h5>
            </div>

            <form action="{{ route('recipes.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <hr class="my-4" />

                <div class="card border mb-4">
                    <div class="card-header">
                        Add products to this recipe
                    </div>
                    <div class="card-body">
                        <table class="table" id="products_table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="product0">
                                    <td>
                                        <select class="form-select" name="products[]">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="quantities[]" value="1" min="1">
                                    </td>
                                </tr>
                                <tr id="product1"></tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-secondary" type="button" id="add_row">Add Row</button>
                            <button class="btn btn-danger" type="button" id="delete_row">Delete Row</button>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Create Recipe</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(() => {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                } );

            // add row
            let row_number = 1;
            $("#add_row").click(function(){
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;
            });

            // delete row
            $("#delete_row").click(function(){
                if(row_number > 1){
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                }
            });
        });
    </script>

@endSection
