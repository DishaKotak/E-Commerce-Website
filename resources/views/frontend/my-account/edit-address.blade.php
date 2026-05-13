@extends('frontend.my-account.layout')

@section('account-content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.address-wrapper {
    max-width: 800px;
}

.address-title {
    font-size: 26px;
    font-weight: bold;
    margin: 20px 0;
}

.address-form {
    background: #fff;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border-radius: 8px;
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 14px;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-group input,
.form-group select {
    padding: 10px;
    border: 1px solid #ccc;
    width: 100%;
}

.full-width {
    width: 100%;
}

.submit-btn {
    background: #90BC79;
    border: none;
    padding: 10px 25px;
    cursor: pointer;
    font-weight: 600;
}

.cancel-btn {
    background: #ccc;
    border: none;
    padding: 10px 25px;
    margin-left: 10px;
    cursor: pointer;
}

@media (max-width:768px) {
    .form-row {
        flex-direction: column;
    }
}
</style>

<div class="address-wrapper">

    <div class="address-title">Edit Address</div>

    <div class="address-form">

        <form action="{{ route('account.address.update', $address->id) }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="full_name" value="{{ $address->full_name }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="text" name="phone" value="{{ $address->phone }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" value="{{ $address->email }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label>Address Line1 *</label>
                    <input type="text" name="address_line1" value="{{ $address->address_line1 }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label>Address Line2</label>
                    <input type="text" name="address_line2" value="{{ $address->address_line2 }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>State *</label>
                    <input type="text" name="state" value="{{ $address->state }}" required>
                </div>

                <div class="form-group">
                    <label>Town / City *</label>
                    <input type="text" name="city" value="{{ $address->city }}" required>
                </div>

                <div class="form-group">
                    <label>Postcode / ZIP *</label>
                    <input type="text" name="postcode" value="{{ $address->postcode }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Landmark</label>
                    <input type="text" name="landmark" value="{{ $address->landmark }}">
                </div>

                <div class="form-group">
                    <label>Address Type</label>
                    <select name="address_type">
                        <option value="home" {{ $address->address_type == 'home' ? 'selected' : '' }}>Home</option>
                        <option value="office" {{ $address->address_type == 'office' ? 'selected' : '' }}>Office
                        </option>
                        <option value="other" {{ $address->address_type == 'other' ? 'selected' : '' }}>Shop</option>
                    </select>
                </div>
            </div>

            <label style="margin-top:5px;">
                <input type="checkbox" name="is_primary" value="1" {{ $address->is_primary ? 'checked' : '' }}>
                Set as Primary Address
            </label><br><br>

            <button type="submit" class="submit-btn">Update Address</button>

            <a href="{{ route('account.addresses') }}">
                <button type="button" class="cancel-btn">Cancel</button>
            </a>

        </form>

    </div>

</div>

@endsection