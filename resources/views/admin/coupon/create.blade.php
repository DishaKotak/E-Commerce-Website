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
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Create Coupon Code</h4>
            {{-- <a href="{{ url('admin/coupons') }}" class="btn btn-secondary btn-sm">Cancel</a> --}}
        </div>

        <div class="card-body">
            <form action="{{ url('admin/coupons/store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Code -->
                    <div class="col-md-6 mb-3">
                        <label>Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Coupon Code">
                    </div>

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Coupon Name">
                    </div>

                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="percent">Percent</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>

                    <!-- Discount -->
                    <div class="col-md-6 mb-3">
                        <label>Discount Amount</label>
                        <input type="number" name="discount_amount" class="form-control" placeholder="Discount Amount">
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6 mb-3">
                        <label>Starts At</label>
                        <input type="datetime-local" name="start_at" class="form-control">
                    </div>

                    <!-- Expire Date -->
                    <div class="col-md-6 mb-3">
                        <label>Expires At</label>
                        <input type="datetime-local" name="expire_at" class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-theme">Create</button>
                    <a href="{{ url('admin/coupons') }}" class="btn btn-theme">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
