@extends('frontend.layouts.main')

@section('main-container')
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

        <form action="{{ route('place.order') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_no" class="form-control" required>
            </div>

            {{-- <div class="mb-3">
            <label>Shipping Address</label>
            <textarea name="shipping_address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Billing Address</label>
            <textarea name="billing_address" class="form-control" required></textarea>
        </div> --}}

            <div class="mb-3">
                <label>Shipping Address</label>
                <select name="shipping_address_id" class="form-control" required>
                    <option value="">Select Address</option>
                    @foreach ($addresses as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state}}, {{ $address->postcode}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Billing Address</label>
                <select name="billing_address_id" class="form-control" required>
                    <option value="">Select Address</option>
                    @foreach ($addresses as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state}}, {{ $address->postcode}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">
                CONFIRM ORDER
            </button>
        </form>
    </div>
@endsection
