@extends('frontend.layouts.main')

@section('main-container')

    <style>
        .card {
            border-radius: 6px;
        }

        img {
            max-height: 140px;
            object-fit: contain;
        }

        .badge {
            font-size: 14px;
            padding: 6px 10px;
        }
    </style>

    <div class="container py-5">
        <h2 class="mb-4">Your Cart </h2>
        <p id="emptyCartMsg" style="display:none;">Your cart is empty</p>

        @if (count($cart) > 0)
            <div class="row">

                <!-- left side -->
                <div class="col-md-8">
                    @foreach ($cart as $id => $item)
                        @if (Auth::check())
                            @php
                                $cartId = $item->product_id;
                                $name = $item->product_name;
                                $price = $item->price;
                                $image = $item->image;
                                $qty = $item->qty;
                            @endphp
                        @else
                            @php
                                $cartId = $id;
                                $name = $item['name'];
                                $price = $item['price'];
                                $image = $item['image'];
                                $qty = $item['quantity'];
                            @endphp
                        @endif

                        <div class="card mb-3 p-3 cart-item cart-item-{{ $cartId }}">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img src="{{ asset('productsimage/' . $image) }}" class="img-fluid">
                                </div>

                                <div class="col-md-6">
                                    <h5>{{ $name }}</h5>
                                    <p class="text-muted mb-1">₹ {{ $price }}</p>

                                    <!-- quantity -->
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Qty:</span>
                                        <span class="qty-{{ $cartId }}">
                                            {{ $qty }}
                                        </span>
                                    </div>

                                    <div class="mt-2">
                                        <a href="{{ route('cart.remove', $cartId) }}" class="text-danger removeBtn">
                                            REMOVE
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 mt-2">

                                    <a href="{{ route('cart.decrease', $cartId) }}"
                                        class="btn btn-outline-secondary btn-sm decreaseBtn">−</a>

                                    <span
                                        class="border border-2 border-secondary px-3 py-1 bg-white fw-semibold qty-{{ $cartId }}">
                                        {{ $qty }}
                                    </span>

                                    <a href="{{ route('cart.increase', $cartId) }}"
                                        class="btn btn-outline-secondary btn-sm increaseBtn">+</a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- right side -->
                <div class="col-md-4">

                    <!-- Apply Coupon -->
                    <div class="mb-2">
                        <div class="d-flex">
                            <input type="text" id="couponCode" class="form-control me-2" placeholder="Enter coupon code"
                                style="border:3px solid #e0e0e0;">

                            <button type="button" class="btn btn-white" id="applyCouponBtn"
                                style="background-color:#90BC79; color:black;">
                                Apply Coupon
                            </button>
                        </div>

                        <small id="couponMsg" class="text-success"></small>
                    </div>

                    <div class="mb-2">
                        <button type="button" class="btn btn-danger mt-0" id="removeCouponBtn">
                            Remove Coupon
                        </button>
                    </div>

                    <div class="card p-3">
                        <h5 class="mb-3">PRICE DETAILS</h5>

                        @php
                            $discount = session('coupon.discount', 0);
                            $finalTotal = $total - $discount;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <span>Price</span>
                            <span id="cartTotal">₹ {{ $total }}</span>
                        </div>

                        <div class="d-flex justify-content-between" id="discountRow"
                            style="{{ $discount > 0 ? '' : 'display:none;' }}">
                            <span>Coupon Discount</span>
                            <span id="discountAmount">- ₹ {{ $discount }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Delivery</span>
                            <span class="text-success">FREE</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total Amount</span>
                            <span id="totalAmount">₹ {{ $finalTotal }}</span>
                        </div>

                        <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger w-100 mt-2 clearCartBtn">
                            Clear Cart
                        </a>

                        <a href="{{ route('checkout') }}" class="btn btn-warning w-100 mt-3">
                            PLACE ORDER
                        </a>

                    </div>
                </div>

            </div>
        @else
            <p>Your cart is empty</p>
        @endif
    </div>

    @push('scripts')
        <script>
            function checkCartEmpty() {
                if ($(".cart-item").length === 0) {
                    $(".row").hide();
                    $("#emptyCartMsg").show();
                }
            }

            $(document).on("click", ".increaseBtn", function(e) {

                e.preventDefault();

                let url = $(this).attr("href");

                $.get(url, function(res) {

                    $(".qty-" + res.id).text(res.qty);

                    let total = parseFloat(res.total).toLocaleString();

                    $("#cartTotal").text("₹ " + res.total);
                    $("#totalAmount").text("₹ " + total);

                });

            });

            $(document).on("click", ".decreaseBtn", function(e) {

                e.preventDefault();

                let url = $(this).attr("href");

                $.get(url, function(res) {

                    if (res.qty == 0) {
                        $(".cart-item-" + res.id).remove();
                    } else {
                        $(".qty-" + res.id).text(res.qty);
                    }

                    let total = Number(res.total).toLocaleString();

                    $("#cartTotal").text("₹ " + total);
                    $("#totalAmount").text("₹ " + total);

                    checkCartEmpty();
                });

            });

            $(document).on("click", ".removeBtn", function(e) {

                e.preventDefault();

                let url = $(this).attr("href");

                $.get(url, function(res) {

                    $(".cart-item-" + res.id).remove();

                    let total = Number(res.total).toLocaleString();

                    $("#cartTotal").text("₹ " + total);
                    $("#totalAmount").text("₹ " + total);

                    checkCartEmpty();
                });

            });

            $(document).on("click", ".clearCartBtn", function(e) {

                e.preventDefault();

                let url = $(this).attr("href");

                $.get(url, function(res) {

                    // sare items remove
                    $("[class^='cart-item-']").remove();

                    // total 0
                    $("#cartTotal").text("₹ 0");
                    $("#totalAmount").text("₹ 0");

                    // cart section hide
                    $(".row").hide();

                    // empty message show
                    $("#emptyCartMsg").show();

                });

            });


            $(document).on('click', '#applyCouponBtn', function() {

                var coupon = $('#couponCode').val();

                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        coupon_code: coupon,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        if (response.status === 'success') {
                            $('#couponMsg')
                                .removeClass('text-danger')
                                .addClass('text-success')
                                .text(response.message);

                            // $('#discountRow').show();
                            // $('#discountAmount').text('- ₹ ' + response.discount);
                            // $('#totalAmount').text('₹ ' + response.total);

                            $('#discountAmount').text('- ₹ ' + Number(response.discount).toLocaleString());
                            $('#totalAmount').text('₹ ' + Number(response.total).toLocaleString());
                            $('#cartTotal').text('₹ ' + Number(response.total).toLocaleString());
                            $('#discountRow').show();
                        } else {
                            $('#couponMsg')
                                .removeClass('text-success')
                                .addClass('text-danger')
                                .text(response.msg);
                        }
                    }
                });

            });

            $(document).on('click', '#removeCouponBtn', function() {

                $.ajax({
                    url: "{{ route('coupon.remove') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        $('#discountRow').hide();
                        $('#discountAmount').text('- ₹ 0');

                        $('#totalAmount').text('₹ ' + response.total);

                        $('#couponMsg').text('Coupon Removed');
                    }
                });

            });
        </script>
    @endpush

@endsection
