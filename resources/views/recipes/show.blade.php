@extends('layout.master')

@section('content')
    <div id="note-full-container" class="note-has-grid row">
        <div class="single-note-item all-category note-{{ $recipe->valid ? 'business' : 'important'}}">
            <div class="card border">
                <div class="card-header">
                    <h5 class="note-title">{{ $recipe->name }} <i class="point fa fa-circle ml-1 font-10"></i></h5>
                </div>
                <div class="card-body">
                    <span class="side-stick"></span>
                    <p class="note-date font-12 text-muted">Created {{ $recipe->created_at->diffForHumans() }}</p>
                    <p>{!! $recipe->description !!}</p>
                    <div class="note-content">
                        <ul>
                            @foreach ($recipe->products as $product)
                                <li>({{ $product->pivot->quantity }} x ) {{ $product->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
