@extends('frontend.layouts.main')

@section('main-container')

@if ($errors->any())
    <div class="alert alert-danger" id="error-box">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">

    <!-- ================= PERSONAL INFO ================= -->
    <div class="card p-3 mb-4">
        <div class="d-flex justify-content-between">
            <h5>Personal Information</h5>
            <a href="#" onclick="editSection('personal')">Edit</a>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="personal">

            <div class="row mt-3">
                <div class="col-md-4">
                    <input type="text" name="first_name" class="form-control personal-field"
                        value="{{ $user->first_name }}" disabled>
                </div>

                <div class="col-md-4">
                    <input type="text" name="last_name" class="form-control personal-field"
                        value="{{ $user->last_name }}" disabled>
                </div>

                <div class="col-md-4 d-none personal-buttons">
                    <button class="btn btn-primary">SAVE</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelEdit('personal')">Cancel</button>
                </div>
            </div>

            <div class="mt-3">
                <label>Your Gender</label><br>
                <input type="radio" name="gender" value="male" class="personal-field"
                    {{ $user->gender == 'male' ? 'checked' : '' }} disabled> Male

                <input type="radio" name="gender" value="female" class="ms-3 personal-field"
                    {{ $user->gender == 'female' ? 'checked' : '' }} disabled> Female
            </div>
        </form>
    </div>

    <!-- ================= ACCOUNT INFO ================= -->
    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <h5>Account Information</h5>
            <a href="#" onclick="editSection('account')">Edit</a>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="account">

            <div class="row mt-3">
                <div class="col-md-4">
                    <input type="email" class="form-control"
                    value="{{ $user->email }}" readonly>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">+91</span>
                        <input type="text" name="mobile" class="form-control account-field"
                            value="{{ $user->mobile ? substr($user->mobile, 3) : '' }}" disabled>
                    </div>
                </div>

                <div class="col-md-4 d-none account-buttons">
                    <button class="btn btn-primary">SAVE</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelEdit('account')">Cancel</button>
                </div>
            </div>
        </form>
    </div>

</div>

<!-- ================= JS ================= -->
<script>
let originalData = {};

function editSection(type) {
    document.querySelectorAll('.' + type + '-field').forEach(el => {
        originalData[el.name] = el.value; // save original
        el.disabled = false;
    });

    document.querySelector('.' + type + '-buttons').classList.remove('d-none');
}

function cancelEdit(type) {
    document.querySelectorAll('.' + type + '-field').forEach(el => {
        el.value = originalData[el.name]; // restore original
        el.disabled = true;
    });

    document.querySelector('.' + type + '-buttons').classList.add('d-none');
}
</script>

<script>
setTimeout(function () {
    let errorBox = document.getElementById('error-box');
    if (errorBox) {
        errorBox.style.transition = "opacity 0.5s ease";
        errorBox.style.opacity = "0";

        setTimeout(() => {
            errorBox.remove();
        }, 500);
    }
}, 5000);
</script>

@endsection
