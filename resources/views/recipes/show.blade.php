@extends('layout.master')

@section('content')
    <div id="note-full-container" class="note-has-grid row">
        <div class="single-note-item all-category note-{{ $recipe->valid ? 'business' : 'important'}}">
            <div class="card border">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="note-title">{{ $recipe->name }} <i class="point fa fa-circle ml-1 font-10"></i></h5>
                    @if ($recipe->valid)
                        <span class="badge bg-success">Ready to cook</span>
                    @else
                        <span class="badge bg-danger">Not ready</span>
                    @endif
                </div>
                <div class="card-body">
                    <span class="side-stick"></span>
                    <p class="note-date font-12 text-muted">Created {{ $recipe->created_at->diffForHumans() }}</p>
                    <h5>Description of this recipe</h5>
                    <p>{!! $recipe->description !!}</p>
                    <hr>
                    <div class="note-content">
                        <h5>Products used in this recipe</h5>
                        <ul>
                            @foreach ($recipe->products as $product)
                                <li class="py-1">
                                    ({{ $product->pivot->quantity }} x ) {{ $product->name }}
                                    @if ($product->pivot->quantity > $product->quantity)
                                        <span class="badge bg-danger">Out of stock</span>
                                        <a href="{{ route('products.edit', $product) }}" class="badge btn btn-sm btn-secondary rounded-pill">Edit</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if(!$recipe->valid)
                    <div class="card-footer">
                        <form action="{{ route('recipes.validate', $recipe->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success">Validate Recipe</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
