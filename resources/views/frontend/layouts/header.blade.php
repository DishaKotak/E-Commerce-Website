<!DOCTYPE html>
<html lang="en">

<style>
.cart-icon {
    font-size: 18px;
}

.cart-badge {
    position: absolute;
    top: 0;
    right: -5px;
    background: #ff3d3d;
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 40%;
    line-height: 1;
}

.search-wrapper {
    position: relative;
}

.search-icon {
    background: none;
    border: none;
    cursor: pointer;
}

.search-icon i {
    font-size: 16px;
    color: #000;
}

#searchForm {
    position: absolute;
    right: 0;
    top: 35px;
    display: none;
}

#searchForm input {
    width: 280px;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
}

.navbar-nav .nav-link {
    white-space: nowrap;
}
</style>


<head>
    <meta charset="utf-8">
    <title>Hairnic - Single Product Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('frontend/img/favicon.ic') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container-fluid px-5">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a href="{{url('/')}}" class="navbar-brand">
                    <h2 class="text-white">Hairnic</h2>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{url('/')}}" class="nav-item nav-link">Home</a>
                        <a href="{{url('/about')}}" class="nav-item nav-link">About</a>
                        <a href="{{url('/products')}}" class="nav-item nav-link">Products</a>
                        <a href="{{ route('track.form') }}" class="nav-item nav-link">
                            Track Order
                        </a>

                        @if(session()->has('auth_session'))
                        <a href="{{ route('my-orders') }}" class="nav-item nav-link">My Orders</a>
                        @endif

                        @if(session()->has('auth_session'))
                        <a href="{{ url('/my-account/addresses') }}" class="nav-item nav-link">My Account</a>
                        @endif

                        <a href="{{url('/contact')}}" class="nav-item nav-link">Contact</a>
                        <div class="d-flex align-items-center ms-3 gap-0">

                            <div class="search-wrapper">
                                <button id="searchToggle" class="search-icon">
                                    <i class="bi bi-search"></i>
                                </button>

                                <form action="{{ route('search') }}" method="GET" id="searchForm">
                                    <input type="text" name="query" placeholder="Search for more"
                                        required>
                                </form>
                            </div>

                            <a href="{{ route('profile') }}" class="nav-item nav-link px-1 me-2">
                                <i class="bi bi-person-circle"></i>
                            </a>

                            <a href="{{ route('wishlist') }}" class="nav-link px-1 me-2">
                            <i class="bi bi-heart"></i>
                            </a>

                            <a href="{{url('/cart')}}" class="nav-item nav-link d-inline-flex align-items-center">
                                <span class="position-relative">
                                    <i class="bi bi-cart cart-icon"></i>
                                    @php
                                    if(Auth::check()){
                                        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                                    }else{
                                        $cartCount = collect(session('cart', []))->count();
                                    }
                                    @endphp

                                    <span class="cart-badge" id="cartCount"
                                    style="{{ $cartCount == 0 ? 'display:none;' : '' }}">
                                    {{ $cartCount }}
                                    </span>
                                </span>

                        </div>

                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <script>
    document.getElementById('searchToggle').addEventListener('click', function () {
        const form = document.getElementById('searchForm');
        form.style.display = form.style.display === 'block' ? 'none' : 'block';
    });
</script>

    <!-- Navbar End -->
