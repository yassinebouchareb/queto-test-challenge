@extends('layout.master')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Recipes List</h4>
                <a href="{{ route('recipes.create') }}" class="btn btn-dark" id="add-recipe">Add Recipe</a>
            </div>
        </div>
    </div>

    <div id="note-full-container" class="note-has-grid row">
        @foreach ($recipes as $recipe)
            <div class="col-md-4 single-note-item note-{{ $recipe->valid ? 'business' : 'important'}}">
                <div class="card card-body">
                    <span class="side-stick"></span>
                    <h5 class="note-title w-75 mb-2">{{ $recipe->name }}</h5>
                    <p class="note-date font-12 text-muted mb-4">
                        {{ $recipe->created_at->diffForHumans() }}
                    </p>
                    <div class="note-content">
                        <ul>
                            @foreach ($recipe->products as $product)
                                <li>(<strong>{{ $product->pivot->quantity }}</strong> x) {{ $product->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if ($recipe->valid)
                                <span class="badge bg-success">Valid</span>
                            @else
                                <span class="badge bg-danger">Invalid</span>
                            @endif
                        </div>
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary btn-sm">View Recipe</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
