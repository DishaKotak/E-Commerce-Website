@extends('frontend.layouts.main')

@section('main-container')

<style>
.order-wrapper {
    max-width: 550px;
    margin: 50px auto;
    padding: 50px;
    border: 2px solid #90BC79;
    border-radius: 30px;
    background: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.order-input {
    padding: 14px;
    font-size: 16px;
    border-radius: 6px;
}

.order-btn {
    background-color: #90BC79 !important;
    color: #000;
    border: none;
    padding: 14px 35px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 6px;
}

.order-btn:hover {
    background-color: #7aa866 !important;
}

.track-banner {
    background: url('frontend/img/track-banner.jpg') center center / cover no-repeat;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.track-banner h1 {
    font-size: 48px;
    color: #333;
    font-weight: 700;
}

</style>

<div class="track-banner">
    <h1>Track Order</h1>
</div>

<div class="order-wrapper">
    <form action="{{ route('track.order') }}" method="POST">
        @csrf 
        <div class="text-center">
            <input type="text" name="tracking_id" 
                   class="form-control mb-4 order-input" 
                   placeholder="Enter your Order ID" required>

            <button type="submit" class="btn order-btn px-4">
                Track Order
            </button>
        </div>
    </form>

    @if(session('error'))
        <div class="text-danger mt-3 text-center">
            {{ session('error') }}
        </div>
    @endif
</div>


@endsection
