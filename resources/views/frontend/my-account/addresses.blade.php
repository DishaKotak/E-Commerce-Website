@extends('frontend.my-account.layout')

@section('account-content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.address-wrapper {
    max-width: 1100px;
}

.address-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-top: 20px;
}

.address-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.btn-green {
    background: #90BC79;
    color: #000;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: 600px;
    margin-bottom: 20px;
}

.btn-green:hover {
    background: #90BC79;
}

.address-card {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    position: relative;
    transition: 0.3s;
}

.address-card:hover {
    transform: translateY(-3px);
}

.address-card h5 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
}

.address-card p {
    margin-bottom: 8px;
    color: #555;
    font-size: 14px;
}

.primary-badge {
    font-size: 12px;
    background: #f4f4f4;
    padding: 3px 8px;
    border-radius: 4px;
    margin-left: 8px;
}

.add-btn {
    background: #90BC79;
    color: #000;
    border: none;
    padding: 10px 18px;
    font-weight: 600;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 15px;
}

.add-btn:hover {
    background: #90BC79;
}

@media (max-width: 768px) {
    .address-grid {
        grid-template-columns: 1fr;
    }
}

.address-form {
    margin-top: 10px;
    border-top: 1px solid #ddd;
    padding-top: 20px;
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

.contact-info {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
}

.icon-box {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #333;
}

.icon-bg {
    width: 28px;
    height: 28px;
    background: #90BC79;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    color: #000;
    font-size: 14px;
}

/* 3 Dot Dropdown */
.card-menu {
    position: absolute;
    top: 15px;
    right: 15px;
}

.menu-btn {
    cursor: pointer;
    font-size: 18px;
    background: none;
    border: none;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 25px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    width: 150px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    z-index: 10;
}

.dropdown-menu a,
.dropdown-menu form button {
    display: block;
    width: 100%;
    padding: 8px 12px;
    text-align: left;
    background: none;
    border: none;
    font-size: 14px;
    cursor: pointer;
    color: #333;
    text-decoration: none;
    font-family: inherit;
}

.dropdown-menu a:hover,
.dropdown-menu button:hover {
    background: #f5f5f5;
}

.dropdown-menu form {
    margin: 0;
}
</style>

<div class="address-wrapper">
    <div class="address-title">Manage Address</div>
    <p>The following addresses will used on the checkout page by default.</p>

    <button onclick="document.getElementById('addressForm').style.display='block'" class="btn-green">
        Add New Address
    </button>

    <div class="address-grid">
        @foreach ($addresses as $address)
        <div class="address-card position-relative">
            <!-- 3 Dot Menu -->
            <div class="card-menu">
                <button class="menu-btn" onclick="toggleMenu({{ $address->id }})">
                    ⋮
                </button>

                <div class="dropdown-menu" id="menu-{{ $address->id }}">

                    <a href="{{ route('account.address.edit', $address->id) }}">
                        Edit
                    </a>

                    @if(!$address->is_primary)
                    <form method="POST" action="{{ route('account.address.primary', $address->id) }}">
                        @csrf
                        <button type="submit">Set as Primary</button>
                    </form>
                    @endif

                    <form method="POST" action="{{ route('account.address.delete', $address->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
            <h5>
                {{ $address->full_name }}
                @if($address->is_primary)
                <span class="primary-badge">Primary</span>
                @endif
            </h5>

            <p>
                {{ $address->address_line1 }}

                @if($address->address_line2)
                , {{ $address->address_line2 }}
                @endif

                , {{ $address->city }}
                , {{ $address->state }} - {{ $address->postcode }}
            </p>

            <div class="contact-info">

                <div class="icon-box">
                    <div class="icon-bg">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    {{ $address->phone }}
                </div>

                <div class="icon-box">
                    <div class="icon-bg">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    {{ $address->email }}
                </div>

            </div>

        </div>
        @endforeach
    </div>


    <!-- addressform -->
    <div id="addressForm" class="address-form" style="display:none;">
        <h4>Add New Address</h4>

        <form action=" {{ route('account.address.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="full_name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="text" name="phone" required>
                </div>

                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label>Address Line1 *</label>
                    <input type="text" name="address_line1" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label>Address Line2 </label>
                    <input type="text" name="address_line2">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>State *</label>
                    <input type="text" name="state" required>
                </div>

                <div class="form-group">
                    <label>Town / City *</label>
                    <input type="text" name="city" required>
                </div>

                <div class="form-group">
                    <label>Postcode / ZIP *</label>
                    <input type="text" name="postcode" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Landmark</label>
                    <input type="text" name="landmark">
                </div>

                <div class="form-group">
                    <label>Address Type</label>
                    <select name="address_type">
                        <option value="home">Home</option>
                        <option value="office">Office</option>
                        <option value="other">Shop</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="submit-btn">Add New</button>

        </form>
    </div>

</div>

<script>
function toggleMenu(id) {

    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
        menu.style.display = 'none';
    });

    var menu = document.getElementById('menu-' + id);

    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}

window.addEventListener('click', function(e) {
    if (!e.target.closest('.card-menu')) {
        document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
            menu.style.display = 'none';
        });
    }
});
</script>

@endsection

