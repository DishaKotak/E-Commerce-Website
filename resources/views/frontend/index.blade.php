@extends('frontend.layouts.main')

@section ('main-container')

<!-- Hero Start -->
<div class="container-fluid bg-primary hero-header mb-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 text-center text-lg-start">
                <h3 class="fw-light text-white animated slideInRight">Natural & Organic</h3>
                <h1 class="display-4 text-white animated slideInRight">Hair <span class="fw-light text-dark">Shampoo</span> For Healthy Hair</h1>
                <p class="text-white mb-4 animated slideInRight">
                    When it comes to hair care, Hairnic brings you products you can truly trust. Made with natural ingredients, our shampoo keeps your hair healthy, shiny, and full of life.
                </p>
                <a href="" class="btn btn-dark py-2 px-4 me-3 animated slideInRight">Shop Now</a>
                <a href="" class="btn btn-outline-dark py-2 px-4 animated slideInRight">Contact Us</a>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid animated pulse infinite" src="{{asset('frontend/img/shampoo.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid animated pulse infinite" src="{{asset('frontend/img/shampoo-1.png')}}">
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="text-primary mb-4">Healthy Hair <span class="fw-light text-dark">Is A Symbol Of Our Beauty</span></h1>
                <p class="mb-4">
                    Hairnic shampoo is specially crafted with natural and organic ingredients to give your hair the care it truly deserves. Our formula helps in reducing hair fall, strengthening roots, and providing deep nourishment from scalp to tip.
                </p>
                <p class="mb-4">
                    With Hairnic, you experience a perfect blend of nature and science. It restores shine, improves hair texture, and keeps your hair healthy, soft, and manageable every day.
                </p>
                <a class="btn btn-primary py-2 px-4" href="">Shop Now</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Deal Start -->
<div class="container-fluid deal bg-primary my-5 py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn">
                <img class="img-fluid animated pulse infinite" src="{{asset('frontend/img/shampoo-2.png')}}">
            </div>
            <div class="col-lg-6 wow fadeIn">
                <div class="bg-white text-center p-4">
                    <div class="border p-4">
                        <p class="mb-2">Natural & Organic Shampoo</p>
                        <h2 class="fw-bold text-uppercase mb-4">Deals of the Day</h2>
                        <h1 class="display-4 text-primary mb-4">$99.99</h1>
                        <h5>Hairnic Organic Shampoo</h5>
                        <p class="mb-4">
                            Experience the power of Hairnic Natural Shampoo at an exclusive price. Enriched with herbal extracts, it deeply cleanses your scalp while keeping your hair smooth, strong, and frizz-free.
                        </p>
                        <a class="btn btn-primary py-2 px-4" href="">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Deal End -->

<!-- Benefits Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4 align-items-center">

            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12 d-flex">
                        <div class="ps-3">
                            <h5>Natural & Organic</h5>
                            <span>Gently cleanses your scalp without removing natural oils.</span>
                        </div>
                    </div>

                    <div class="col-12 d-flex">
                        <div class="ps-3">
                            <h5>Anti Hair Fall</h5>
                            <span>Helps reduce hair fall and promotes stronger hair growth.</span>
                        </div>
                    </div>

                    <div class="col-12 d-flex">
                        <div class="ps-3">
                            <h5>Anti-dandruff</h5>
                            <span>Removes dandruff and keeps scalp fresh and healthy.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-center">
                <img class="img-fluid" src="{{asset('frontend/img/shampoo.png')}}">
            </div>

            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12">
                        <h5>No Side Effects</h5>
                        <span>Safe for regular use with no harmful chemicals.</span>
                    </div>

                    <div class="col-12">
                        <h5>No Irritation</h5>
                        <span>Prevents dryness and irritation on sensitive scalp.</span>
                    </div>

                    <div class="col-12">
                        <h5>Fresh Fragrance</h5>
                        <span>Leaves a refreshing natural fragrance after every wash.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Benefits End -->

@endsection
