<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h3 class="mb-4">Order#: {{ $order->id }}</h3>

    <div class="row g-4">

        <!-- left side -->
        <div class="col-md-8">

            <!-- delivery card -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-0">Estimated Delivery Date</h5>
                    <h3 class="mt-2 mb-1">
                        {{ \Carbon\Carbon::parse($order->delivery_date)->format('l, F d') }}
                    </h3>
                    <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" class="form-select fw-bold text-success" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending Payment
                            </option>
                            <option value="confirmed" {{ $order->status=='confirmed'?'selected':'' }}>Order Received
                            </option>
                            <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Order In
                                Progress</option>
                            <option value="ready_to_ship" {{ $order->status=='ready_to_ship'?'selected':'' }}>Order
                                Ready To Ship</option>
                            <option value="shipped" {{ $order->status=='shipped'?'selected':'' }}>Shipped</option>
                            <option value="out_for_delivery" {{ $order->status=='out_for_delivery'?'selected':'' }}>Out
                                For Delivery</option>
                            <option value="delivered" {{ $order->status=='delivered'?'selected':'' }}>Delivered</option>
                        </select>
                    </form>
                    <hr>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <h6>Shipping Address</h6>
                            <p class="mb-0">
                                {{ $order->user->name ?? 'N/A'}}<br>
                                {{ $order->billing_address }}<br>
                                {{ $order->phone_no }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Delivery Method</h6>
                            <p class="mb-0">Standard (5-7 Business Days)</p>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-0">
                        <strong>Product ID:</strong>
                        {{ $order->items->first()->product_id ?? 'N/A' }}
                    </p> -->

                    <!-- <h5 class="mb-3">Address</h5>

                    <div class="mb-3">
                        <select id="address_type" class="form-select" onchange="toggleAddress()">
                            <option value="shipping">Shipping Address</option>
                            <option value="billing">Billing Address</option>
                        </select>
                    </div> -->

                    <!-- SHIPPING DETAILS -->
                    <!-- <div id="shipping_block">
                        <form action="{{ route('admin.order.updateAddress', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Select Shipping Address</label>
                                <select name="shipping_address_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Select Shipping Address --</option>
                                    @foreach($addresses as $addr)
                                    <option value="{{ $addr->id }}"
                                        {{ $order->shipping_address_id == $addr->id ? 'selected' : '' }}>
                                        {{ $addr->addressline1 }}, {{ $addr->city }} - {{ $addr->pincode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if($order->shippingAddress)
                        <p><strong>Name:</strong> {{ $order->shippingAddress->full_name ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $order->shippingAddress->phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $order->shippingAddress->email ?? 'N/A' }}</p>
                        <p><strong>Address Line 1:</strong> {{ $order->shippingAddress->address_line1 ?? 'N/A' }}</p>
                        <p><strong>City:</strong> {{ $order->shippingAddress->city ?? 'N/A' }}</p>
                        <p><strong>State:</strong> {{ $order->shippingAddress->state ?? 'N/A' }}</p>
                        <p><strong>Pincode:</strong> {{ $order->shippingAddress->postcode ?? 'N/A' }}</p>
                        @endif
                    </div> -->

                    <!-- BILLING DETAILS -->
                    <!-- <div id="billing_block" style="display:none;">
                        <form action="{{ route('admin.order.updateAddress', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Select Billing Address</label>
                                <select name="billing_address_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Select Billing Address --</option>
                                    @foreach($addresses as $addr)
                                    <option value="{{ $addr->id }}"
                                        {{ $order->billing_address_id == $addr->id ? 'selected' : '' }}>
                                        {{ $addr->addressline2 ?? $addr->addressline1 }}, {{ $addr->city }} -
                                        {{ $addr->pincode }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if($order->billingAddress)
                        <p><strong>Name:</strong> {{ $order->billingAddress->full_name ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $order->billingAddress->phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $order->billingAddress->email ?? 'N/A' }}</p>
                        <p><strong>Address Line 2:</strong>
                            {{ $order->billingAddress->address_line2 ?? $order->billingAddress->address_line1 ?? 'N/A' }}
                        </p>
                        <p><strong>City:</strong> {{ $order->billingAddress->city ?? 'N/A' }}</p>
                        <p><strong>State:</strong> {{ $order->billingAddress->state ?? 'N/A' }}</p>
                        <p><strong>Pincode:</strong> {{ $order->billingAddress->postcode ?? 'N/A' }}</p>
                        @endif
                    </div>

                    <script>
                    function toggleAddress() {
                        let type = document.getElementById("address_type").value;

                        document.getElementById("shipping_block").style.display =
                            (type === "shipping") ? "block" : "none";

                        document.getElementById("billing_block").style.display =
                            (type === "billing") ? "block" : "none";
                    }
                    </script> -->

                    <h5 class="mb-3">Address</h5>

                    <div class="row">

                        <!-- SHIPPING -->
                        <div class="col-md-6">
                            <form action="{{ route('admin.order.updateAddress', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Shipping Address</label>
                                    <select name="shipping_address_id" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value=""> Select Shipping Address </option>
                                        @foreach($addresses as $addr)
                                        <option value="{{ $addr->id }}"
                                            {{ $order->shipping_address_id == $addr->id ? 'selected' : '' }}>
                                            {{ $addr->addressline1 }}, {{ $addr->city }} - {{ $addr->pincode }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            @if($order->shippingAddress)
                            <div class="border p-2 rounded bg-light">
                                <p><strong>Name:</strong> {{ $order->shippingAddress->full_name }}</p>
                                <p><strong>Address:</strong> {{ $order->shippingAddress->address_line1 }}</p>
                                <p><strong>Phone:</strong> {{ $order->shippingAddress->phone }}</p>
                                <p><strong>City:</strong> {{ $order->shippingAddress->city }}</p>
                                <p><strong>Pincode:</strong> {{ $order->shippingAddress->postcode }}</p>
                            </div>
                            @endif
                        </div>


                        <!-- BILLING -->
                        <div class="col-md-6">
                            <form action="{{ route('admin.order.updateAddress', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Billing Address</label>
                                    <select name="billing_address_id" class="form-select" onchange="this.form.submit()">
                                        <option value=""> Select Billing Address </option>
                                        @foreach($addresses as $addr)
                                        <option value="{{ $addr->id }}"
                                            {{ $order->billing_address_id == $addr->id ? 'selected' : '' }}>
                                            {{ $addr->addressline1 }}, {{ $addr->city }} - {{ $addr->pincode }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            @if($order->billingAddress)
                            <div class="border p-2 rounded bg-light">
                                <p><strong>Name:</strong> {{ $order->billingAddress->full_name }}</p>
                                <p><strong>Address:</strong> {{ $order->billingAddress->address_line1 }}</p>
                                <p><strong>Phone:</strong> {{ $order->billingAddress->phone }}</p>
                                <p><strong>City:</strong> {{ $order->billingAddress->city }}</p>
                                <p><strong>Pincode:</strong> {{ $order->billingAddress->postcode }}</p>
                            </div>
                            @endif
                        </div>

                    </div>


                </div>
            </div>

            <!-- package items card -->
            <div class="card mb-0">
                <div class="card-body">
                    <h5 class="mb-3">Package Items</h5>
                    @foreach($order->items as $item)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('productsimage/'.$item->product->image) }}" width="70" height="80"
                            class="me-3 rounded">
                        <div>
                            <h6 class="mb-0">{{ $item->product->name }}</h6>
                            <small>Quantity: {{ $item->qty }}</small><br>
                            <strong>₹{{ number_format($item->price,2) }}</strong>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">

    <a href="{{ route('admin.order.decrease', $item->id) }}"
        class="btn btn-outline-secondary btn-sm">−</a>

    <span class="border px-3 py-1">
        {{ $item->qty }}
    </span>

    <a href="{{ route('admin.order.increase', $item->id) }}"
        class="btn btn-outline-secondary btn-sm">+</a>

    <a href="{{ route('admin.order.delete', $item->id) }}"
        class="btn btn-danger btn-sm">Delete</a>

</div>

                    @if(!$loop->last)
                    <hr>
                    @endif
                    @endforeach

                </div>
            </div>

        </div>


        <!-- right side -->
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body pb-4">
                    <h5>Order Summary</h5>
                    <hr>
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }}</span>
                        <span>₹{{ number_format($item->price,2) }}</span>
                    </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->total_amount,2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>₹{{ number_format($order->total_amount,2) }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
