@extends('admin.layout.main')

@section('main-container')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<style>
    .alert-success {
    background-color: #fff !important;
    color: #000 !important;
    }

    .custom-toast {
        position: fixed;
        top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);

    background: #ffffff;
    color: #5B6B82;

    padding: 12px 22px;

    font-size: 14px;
    font-weight: 1000;

    box-shadow: 0 4px 15px rgba(0,0,0,0.15);

    z-index: 9999;

    opacity: 0;
    animation: fadeIn 0.4s forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate(-50%, -60%);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

.table-light {
    background-color: white;
    color: #5B6B82;
}
</style>

@if(session('success'))
    <div id="successMsg" class="custom-toast">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Discount Coupons</h4>

            <a href="{{ route('coupons.create') }}" class="btn btn-primary btn-sm">
                New Discount Coupon
            </a>
        </div>

        <div class="card-body">

            <!-- Top Controls -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-secondary btn-sm">Reset</button>

                <div class="input-group w-25">
                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                    <button class="btn btn-outline-secondary btn-sm">
                        🔍
                    </button>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->name }}</td>

                        <td>
                            @if($coupon->type == 'percent')
                                {{ $coupon->discount_amount }} %
                            @else
                                ${{ $coupon->discount_amount }}
                            @endif
                        </td>

                        <td>{{ $coupon->start_at }}</td>
                        <td>{{ $coupon->expire_at }}</td>

                        <!-- Status -->
                        <td>
                            @if($coupon->status)
                                <span class="text-white">✔</span>
                            @else
                                <span class="text-danger">✖</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="text-center align-middle">
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-link text-white p-2">
                            <i class="fa fa-pencil" style="font-size:13px"></i>
                        </a>


                            <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-white p-2">
                                    <i class="fa fa-trash" style="font-size:13px"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

<script>
    setTimeout(function () {
        let msg = document.getElementById('successMsg');
        if (msg) {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>
@endsection
