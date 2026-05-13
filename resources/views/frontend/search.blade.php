@extends('frontend.layouts.main')

@section('main-container')

<div class="container py-5">
    <h4 class="mb-4">Search Result For: "{{ $query }}"</h4>

    @if($products->count() > 0)
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('productsimage/' .$product->image)}}" class="card-img-top">
                <div class="card-body">
                    <h6> {{ $product->name}} </h6>
                    <p> {{ $product->price}} </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No Products Found</p>
    @endif
</div>

@endsection
