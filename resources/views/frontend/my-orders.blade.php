@extends('frontend.layouts.main')

@section('main-container')
    @php
        $statusColors = [
            'pending' => 'text-secondary',
            'received' => 'text-info',
            'processing' => 'text-primary',
            'ready_to_ship' => 'text-warning',
            'shipped' => 'text-warning',
            'out_for_delivery' => 'text-warning',
            'delivered' => 'text-success',
        ];

        $steps = [
            'pending' => 'Pending Payment',
            'received' => 'Order Received',
            'processing' => 'Order In Progress',
            'ready_to_ship' => 'Ready To Ship',
            'shipped' => 'Shipped',
            'out_for_delivery' => 'Out For Delivery',
            'delivered' => 'Delivered',
        ];
    @endphp

    <div class="container my-5">
        <h3 class="mb-4">My Orders</h3>

        @forelse($orders as $order)
            <a href="{{ route('order.detailsuser', $order->id) }}" class="text-decoration-none text-dark">
                <div class="card mb-3 shadow-sm p-3 order-card">

                    <div class="d-flex align-items-center">

                        <!-- Product Image -->
                        @php
                        $item = $order->items->first();
                        $product = $item?->product;
                        @endphp

                        @if($item && $item->product)
                            <img src="{{ asset('productsimage/' . $item->product->image) }}" width="80" class="me-3">
                        @else
                            <img src="{{ asset('productsimage/default.png') }}" width="80" class="me-3">
                        @endif

                        <!-- Product Info -->
                        <div>
                            <h6 class="mb-1">
                                {{ $product?->name ?? 'Product Removed' }}
                            </h6>

                            <p class="mb-0 text-muted">
                                ₹{{ number_format($item->price ?? 0) }}
                            </p>
                        </div>

                        <!-- Right Side -->
                        <div class="ms-auto text-end">
                            <p class="mb-1 fw-bold {{ $statusColors[$order->status] ?? 'text-dark' }}">
                                ● {{ $steps[$order->status] ?? ucfirst($order->status) }}
                            </p>

                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                            </small>

                            <br>

                        </div>

                    </div>

                </div>
            </a>

        @empty
            <p>No orders found.</p>
        @endforelse
    </div>

    <style>
        .order-card:hover {
            transform: scale(1.01);
            transition: 0.2s;
        }
    </style>
@endsection
