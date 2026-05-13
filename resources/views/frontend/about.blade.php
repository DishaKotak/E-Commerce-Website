@extends('frontend.layouts.main')

@section ('main-container')

<!-- Hero Start -->
<div class="container-fluid bg-primary hero-header mb-5">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animated slideInDown">About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item text-white active">About</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Hero End -->


<!-- Feature Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 wow fadeIn">
                <div class="feature-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-leaf fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">100% Natural Ingredients</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeIn">
                <div class="feature-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-tint-slash fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">Reduces Hair Fall</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeIn">
                <div class="feature-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-times fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">Safe & Chemical-Free</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Feature End -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeIn">
                <img class="img-fluid animated pulse infinite" src="{{asset('frontend/img/shampoo-1.png')}}">
            </div>

            <div class="col-lg-6 wow fadeIn">
                <h1 class="text-primary mb-4">
                    Healthy Hair <span class="fw-light text-dark">Starts With Hairnic</span>
                </h1>

                <p class="mb-4">
                    Hairnic is a trusted hair care brand focused on delivering natural and effective solutions for modern hair problems. Our shampoo is made using carefully selected herbal ingredients that nourish your scalp, strengthen your roots, and improve overall hair health.
                </p>

                <p class="mb-4">
                    We believe that healthy hair is a reflection of confidence and beauty. That’s why Hairnic products are designed to be gentle, chemical-free, and suitable for all hair types. Whether you are dealing with hair fall, dandruff, or dryness, Hairnic provides the right care your hair deserves.
                </p>

                <a class="btn btn-primary py-2 px-4" href="">Shop Now</a>
            </div>

        </div>
    </div>
</div>
<!-- About End -->


<!-- Newsletter Start -->
<div class="container-fluid newsletter bg-primary py-5 my-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" style="max-width: 600px;">
            <h1 class="text-white mb-3">
                <span class="fw-light text-dark">Stay Updated</span> With Hairnic
            </h1>
            <p class="text-white mb-4">
                Subscribe to get the latest updates, exclusive offers, and expert hair care tips directly to your inbox.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7 wow fadeIn">
                <div class="position-relative w-100 mt-3 mb-2">
                    <input class="form-control w-100 py-4 ps-4 pe-5" type="email" placeholder="Enter Your Email">
                    <button type="button" class="btn position-absolute top-0 end-0 mt-1 me-2">
                        <i class="fa fa-paper-plane text-white fs-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

@endsection
