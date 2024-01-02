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

    <div class=" w-50 mb-4">
        <span>Filter by : </span>
        <a href="{{ route('recipes.index') }}" class="badge btn btn-secondary rounded-pill mr-2">All</a>
        <a href="{{ request()->fullUrlWithQuery(['valid' => '1']) }}" class="badge btn btn-secondary rounded-pill">Ready to cook</a>
        <a href="{{ request()->fullUrlWithQuery(['valid' => '0']) }}" class="badge btn btn-secondary rounded-pill">Not ready</a>
    </div>

    @if ($recipes->count())
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
                                <span class="badge bg-success">Ready to cook</span>
                            @else
                                <span class="badge bg-danger">Not ready</span>
                            @endif
                        </div>
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary btn-sm">View Recipe</a>
                    </div>
                </div>
            </div>
        @endforeach

        {!! $recipes->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
    @else
    <div class="alert alert-warning d-flex align-items-center" role="alert">

        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
          </svg>
        <div>
            No recipes found in the database, please add a new recipe.
        </div>
    </div>
    @endif
@endsection
