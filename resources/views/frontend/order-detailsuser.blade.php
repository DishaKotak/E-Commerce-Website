@extends('frontend.layouts.main')

@section('main-container')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* =========================
   ORDER PROGRESS BAR
========================= */
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
    border-right: 3px solid #fff;
    border-bottom: 3px solid #fff;
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

/* =========================
   TIMELINE
========================= */
.timeline {
    position: relative;
    padding-left: 0px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    width: 3px;
    height: calc(100% - 20px);
    background: #e0e0e0;
    border-radius: 10px;
}

.timeline-progress {
    position: absolute;
    left: 10px;
    top: 0;
    width: 3px;
    height: 0;
    background: #90BC79;
    transition: height 1.2s ease;
    border-radius: 10px;
}

.timeline-step {
    position: relative;
    margin-bottom: 35px;
    padding-left: 30px;
}

.timeline-step .dot {
    position: absolute;
    left: 4px;
    top: 2px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #dcdcdc;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dcdcdc;
}

.timeline-step.active .dot {
    background: #90BC79;
    box-shadow: 0 0 0 2px #90BC79;
}

.timeline-step .content {
    font-size: 14px;
    line-height: 1.4;
}

.order-progress .line:last-of-type {
    display: none;
}
</style>

<div class="container my-5">

    <h3 class="mb-4">Order Details</h3>

    <div class="row">

        {{-- ================= LEFT SECTION ================= --}}
        <div class="col-md-8">

            <div class="card p-4 mb-3">

                @foreach ($items as $item)
                    <h5>{{ $item->product_name }}</h5>
                @endforeach

                <h5>₹{{ number_format($order->total_amount) }}</h5>

                @php
                    $steps = [
                        'pending' => 'Pending Payment',
                        'received' => 'Order Received',
                        'processing' => 'Order In Progress',
                        'ready_to_ship' => 'Order Ready To Ship',
                        'shipped' => 'Shipped',
                        'out_for_delivery' => 'Out For Delivery',
                        'delivered' => 'Delivered',
                    ];

                    $visibleSteps = array_slice($steps, 0, 3);
                    $currentStep = array_search($order->status, array_keys($steps));
                @endphp

                <div class="order-progress mt-4">

                    @foreach ($visibleSteps as $key => $label)
                        <div class="step {{ $loop->index <= $currentStep ? 'active' : '' }}">
                            <div class="circle"></div>
                            <p>{{ $label }}</p>
                        </div>

                        @if (!$loop->last && $loop->index < count($visibleSteps) - 1)
                            <div class="line {{ $loop->index < $currentStep ? 'active' : '' }}"></div>
                        @endif
                    @endforeach

                </div>

                <a href="#" data-bs-toggle="modal" data-bs-target="#orderTimeline">
                    See All Updates
                </a>

            </div>

            <div class="mt-3 p-3 border rounded bg-light">
                <small class="text-muted" class="me-2">Order Tracking ID</small><br>
                    <div class="d-flex align-items-center">
                <strong id="trackingId" class="me-1"> {{ $order->tracking_id ?? 'N/A' }}</strong>
                <button id="copyBtn" class="btn p-1" onclick="copyTrackingId()" style="font-size: 14px;">
                <i class="bi bi-clipboard"></i>
                </button>
            </div>

        </div>
    </div>

        {{-- ================= RIGHT SECTION ================= --}}
        <div class="col-md-4">

            <div class="card p-3 mb-3">

                <h6>Delivery Details</h6>

                <div class="d-flex align-items-start mb-1">
                    <i class="bi bi-house me-2"></i>
                    <div style="line-height:1.3;">
                        <strong>Home</strong>
                        {{ $order->user_address ?? 'No Address' }}
                    </div>
                </div>

                <hr class="my-3">

                <div class="d-flex align-items-start">
                    <i class="bi bi-person me-2"></i>
                    <div style="line-height:1.3;">
                        <strong>{{ $order->full_name ?? '' }}</strong>
                        {{ $order->phone ?? '' }}
                    </div>
                </div>

            </div>

            <div class="card p-3">

                <h6>Price Details</h6>

                <div class="d-flex justify-content-between">
                    <span>Selling price</span>
                    <span>₹{{ number_format($order->total_amount) }}</span>
                </div>

                @if ($order->discount > 0)
                    <div class="d-flex justify-content-between">
                        <span>Other discount</span>
                        <span>-₹{{ number_format($order->discount) }}</span>
                    </div>
                @endif

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Total</h5>
                    <h5 class="mb-0">₹{{ number_format($order->final_amount) }}</h5>
                </div>

                <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-light border w-100 mt-3">
                <i class="fa fa-download"></i> Download Invoice
                </a>

            </div>

        </div>

    </div>
</div>

{{-- ================= ORDER TIMELINE MODAL ================= --}}
<div class="modal fade" id="orderTimeline" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h5>Order Updates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="timeline">

                    <div class="timeline-progress" id="progressBar"></div>

                    @foreach ($steps as $key => $label)
                        <div class="timeline-step {{ $loop->index <= $currentStep ? 'active' : '' }}">
                            <div class="dot"></div>
                            <div class="content">
                                <strong>{{ $label }}</strong><br>
                                <small>Status update...</small>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById('orderTimeline');

    modal.addEventListener('shown.bs.modal', function () {

        const progress = document.getElementById('progressBar');
        const activeSteps = document.querySelectorAll('.timeline-step.active');

        if (!progress) return;

        progress.style.transition = "none";
        progress.style.height = "0px";

        void progress.offsetHeight;

        progress.style.transition = "height 1.2s ease";

        setTimeout(() => {
            if (activeSteps.length > 0) {
                const last = activeSteps[activeSteps.length - 1];

                const dot = last.querySelector('.dot');
                progress.style.height =
                (last.offsetTop + dot.offsetTop + dot.offsetHeight / 2) + "px";
            }
        }, 50);

    });

});
</script>

<script>
function copyTrackingId() {
    let text = document.getElementById("trackingId").innerText;
    let btn = document.getElementById("copyBtn");

    navigator.clipboard.writeText(text).then(function() {
        btn.innerHTML = "Copied!";

        setTimeout(() => {
            btn.innerHTML = '<i class="bi bi-clipboard"></i>';
        }, 1500);
    });
}
</script>

@endsection
