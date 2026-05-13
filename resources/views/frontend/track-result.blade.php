@extends('frontend.layouts.main')

@section('main-container')

<style>
.order-progress {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 25px 0;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
}

.circle {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #dcdcdc;
    margin: 0 auto 6px;
    position: relative;
}

.step.active .circle {
    background: #90BC79;
}

.step.active .circle::after {
    content: '';
    position: absolute;
    width: 7px;
    height: 12px;
    border-right: 3px solid #ffffff;
    border-bottom: 3px solid #ffffff;
    transform: rotate(45deg);
    left: 9px;
    top: 6px;
}

.step p {
    font-size: 12px;
    color: #555;
    margin: 0;
}

.line {
    flex: 1;
    height: 3px;
    background: #dcdcdc;
    margin: 0 6px;
    border-radius: 3px;
}

.line.active {
    background: #90BC79;
}
</style>

@php 
$steps = [
    'pending'=>'Pending Payment',
    'received' => 'Order Received',
    'processing' => 'Order In Progress',
    'ready_to_ship' => 'Order Ready To Ship',
    'shipped'=> 'Shipped',
    'out_for_delivery' => 'Out For Delivery',
    'delivered' => 'Delivered'
]; 

$currentStep = array_search($order->status, array_keys($steps));
@endphp

<h3 class="text-center mb-4">Order Details</h3>

<div class="card p-4">
    <p><strong>Tracking ID:</strong>{{ $order->tracking_id}}</p>
    <p><strong>Order Date:</strong>{{ $order->created_at->format('d M Y')}}</p>
    <p><strong>Status:</strong></p> 
    <div class="order-progress">
        @foreach ($steps as $key => $label)
        <div class="step {{$loop->index <= $currentStep ? 'active' : '' }}">
            <div class="circle">
                @if($loop->index <= $currentStep)
                
                @endif
            </div>
            <p>{{ $label }}</p>
        </div>

        @if(!$loop->last)
        <div class="line {{$loop->index < $currentStep ? 'active' : '' }}"> </div>
        @endif 
        @endforeach
    </div>
    <p><strong>Total Amount:</strong> ₹{{ number_format ($order->total_amount, 0) }}</p>
</div>

@endsection
