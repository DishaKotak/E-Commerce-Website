@extends('frontend.layouts.main')

@section('main-container')

<style>
.product-item {
    height: 100%;
}

.product-img {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.product-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.product-item {
    position: relative;
}

.bi-heart {
    color: black;
}

.bi-heart-fill {
    color: red;
}

.product-item {
    display: flex;
    flex-direction: column;
}

.product-item h5 {
    margin-top: auto;
}
</style>

<div id="cartMessage"
style="
position:fixed;
top:90%;
left:50%;
transform:translate(-50%,-50%);
background:#90bc79;
color:white;
padding:12px 25px;
border-radius:6px;
display:none;
z-index:9999;
font-weight:600;">
Product Added To Cart
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <div id="wishlistMessage" style="position:fixed; bottom:30px; left:50%;
    transform:translateX(-50%);
    background:#222; color:#fff;
    padding:12px 25px;
    border-radius:6px;
    display:none; z-index:9999;">
</div> -->

<!-- Hero Start -->
<div class="container-fluid bg-primary hero-header mb-5">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animated slideInDown">Products</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Hero End -->

<!-- Product Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="text-primary mb-3"><span class="fw-light text-dark">Our Natural</span> Hair Products</h1>
            <p class="mb-5">Discover our range of natural shampoos designed to gently cleanse, nourish, and strengthen your hair, leaving it healthy, soft, and naturally radiant.</p>
        </div>
        <div class="row g-4">

            {{-- <div class="text-end mb-4">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    Add New Product
                </a>
            </div> --}}

            @foreach($products as $product)
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="product-item text-center border h-100 p-4">
                    <div class="product-img mb-4">
                        <img src="{{ asset('productsimage/'.$product->image) }}" alt="{{ $product->name }}">
                    </div>

                    @if(Auth::check())
                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                        style="position: absolute; top: 10px; right: 10px;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <i class="bi
                            {{ \App\Models\Wishlist::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->exists()
                            ? 'bi-heart-fill text-danger'
                            : 'bi-heart' }}">
                                    </i>
                                </button>
                            </form>
                            @endif

                    <a href="#" class="h6 d-inline-block mb-2">{{ $product->name }}</a>
                    <!-- <a href="#" class="h6 d-inline-block mb-2">{{ $product->description }}</a> -->
                    <h5 class="text-primary mb-3">₹ {{ number_format($product->price, 2, '.', '') + 0 }}</h5>
                    <!-- <a href="{{route('cart.add', $product->id) }}" class="btn btn-outline-primary px-3 addToCartBtn">Add To Cart</a> -->
                     <button class="btn btn-outline-primary px-3 addToCartBtn"
                     data-id="{{ $product->id }}">
                     Add To Cart
                     </button>
                     </div>
                     </div>
            @endforeach

            <div class="col-12 text-center">
                <a class="btn btn-primary py-2 px-4" href="#">Load More Products</a>
            </div>
        </div>
    </div>
</div>
<!-- Product End -->

<!-- Newsletter Start -->
<div class="container-fluid newsletter bg-primary py-5 my-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="text-white mb-3"><span class="fw-light text-dark">Let's Subscribe</span> The Newsletter</h1>
            <p class="text-white mb-4">Subscribe now to get 30% discount on any of our products</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 wow fadeIn" data-wow-delay="0.5s">
                <div class="position-relative w-100 mt-3 mb-2">
                    <input class="form-control w-100 py-4 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                        style="height: 48px;">
                    <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                            class="fa fa-paper-plane text-white fs-4"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

@if(session('message'))
<script>
document.addEventListener("DOMContentLoaded", function() {

    let box = document.getElementById("flashMessage");
    if(!box) return;

    box.innerText = "{{ session('message') }}";
    box.style.display = "block";

    setTimeout(function(){
        box.style.display = "none";
    }, 3000);

});
</script>
@endif

<script>
$(document).on("click",".addToCartBtn",function(e){

    e.preventDefault();

    let product_id = $(this).data("id");

    $.ajax({
        url: "/add-to-cart/" + product_id,
        type: "GET",
        success: function(res){

        if(res.success){

        $("#cartMessage").fadeIn();

            setTimeout(function(){
                $("#cartMessage").fadeOut();
            },3000);
        }

        $("#cartCount").text(res.count).show();

        }
    });

});
</script>
@endsection
