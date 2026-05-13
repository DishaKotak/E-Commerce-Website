@extends('admin.layout.main')

@section('main-container')

<style>
    ::placeholder {
        color: white !important;
        opacity: 1;
    }

    .btn-theme {
        background-color: #5B6B82;
        color: white;
    }

    select {
        background-color: #5B6B82;
        color: #fff;
        border: none;
    }

    select option {
        color: #000;
        background-color: #fff;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
    }
</style>

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Edit Coupon Code</h4>
        </div>

        <div class="card-body">
            <form action="{{ url('admin/coupons/update/'.$coupon->id) }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Code -->
                    <div class="col-md-6 mb-3">
                        <label>Code</label>
                        <input type="text" name="code" class="form-control"
                               value="{{ $coupon->code }}" placeholder="Coupon Code">
                    </div>

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $coupon->name }}" placeholder="Coupon Name">
                    </div>

                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                            <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        </select>
                    </div>

                    <!-- Discount -->
                    <div class="col-md-6 mb-3">
                        <label>Discount Amount</label>
                        <input type="number" name="discount_amount" class="form-control"
                               value="{{ $coupon->discount_amount }}" placeholder="Discount Amount">
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6 mb-3">
                        <label>Starts At</label>
                        <input type="datetime-local" name="start_at" class="form-control"
                               value="{{ $coupon->start_at ? \Carbon\Carbon::parse($coupon->start_at)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <!-- Expire Date -->
                    <div class="col-md-6 mb-3">
                        <label>Expires At</label>
                        <input type="datetime-local" name="expire_at" class="form-control"
                               value="{{ $coupon->expire_at ? \Carbon\Carbon::parse($coupon->expire_at)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-theme">Update</button>
                    <a href="{{ url('admin/coupons') }}" class="btn btn-theme">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
