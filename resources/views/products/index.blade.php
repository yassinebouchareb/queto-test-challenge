@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-5">
                <h4 class="card-title">Products List</h4>
                <a href="javascript:void(0)" class="btn btn-dark" id="add-product">Add Product</a>
            </div>

            @if ($products->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Expiration Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($products as $product)
                            <tr class="{{ $product->is_expired ? 'tr-expired' : '' }}">
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::words($product->description, 6) }}</td>
                                <td  class="text-center">{{ $product->quantity }}</td>
                                <td>
                                    @if ($product->is_expired)
                                        <span class="badge bg-danger">Expired</span>
                                    @else
                                        {{ $product->expiration_date->format('Y-m-d') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($product->is_in_stock)
                                        <span class="badge bg-success">In Stock</span>
                                    @else
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
            @else
                <div class="alert alert-warning d-flex align-items-center" role="alert">

                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                      </svg>
                    <div>
                    No products found in the database, please add a new product.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endSection
