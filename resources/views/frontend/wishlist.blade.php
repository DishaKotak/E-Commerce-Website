@extends('frontend.layouts.main')

@section('main-container')

<div class="container my-5">
    <h3 class="mb-4">My Wishlist</h3>

    @foreach($wishlist as $item)
    <div class="d-flex align-items-center border p-3 mb-3">

        <img src="{{ asset('productsimage/'.$item->product->image) }}"
             width="120" class="me-4">

        <div class="flex-grow-1">
            <h5>{{ $item->product->name }}</h5>
            <h5 class="text-dark">₹{{ $item->product->price }}</h5>
        </div>

        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i>
        </button>
        </form>

    </div>
    @endforeach

</div>

@endsection