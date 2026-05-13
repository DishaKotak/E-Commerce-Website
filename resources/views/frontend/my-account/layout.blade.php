<style>
.account-wrapper {
    display: flex;
    gap: 30px;
}

.sidebar {
    margin-top: 50px;
    width: 15%;
}

.sidebar ul {
    list-style: none;
    padding: 0%;
    border: none;
}

.sidebar ul li {
    border-bottom: 1px solid #ddd;
    text-align:center;
}

.sidebar ul li a {
    display: block;
    padding: 14px 0px;
    text-decoration: none;
    color: #000;
}

.sidebar ul li a:hover {
    background: #90BC79; 
    color: #000;
}

.account-content {
    width: 75%;
}

@media (max-width:768px) {
    .account-wrapper {
        flex-direction: colunm;
    }

    .sidebar,
    .account-content {
        width: 100%;
    }
}

.track-banner {
    background-image: url('{{ asset("frontend/img/track-banner.jpg") }}');
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.track-banner h1 {
    font-size: 48px;
    color: #333;
    font-weight: 700;
}

</style>

<div class="track-banner">
    <h1>My Account</h1>
</div>

<div class="account-wrapper">
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="{{ route ('account.addresses')}}">Addresses</a></li>
            <li><a href="#">Account Details</a></li>
            <li><a href="{{ url('/logout') }}">Sign Out</a></li>
        </ul>
    </div>

    <div class="account-content">
        @yield('account-content')
    </div>
</div>