@extends('frontend.layouts.main')

@section ('main-container')

<!-- Hero Start -->
<div class="container-fluid bg-primary hero-header mb-5">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animated slideInDown">Contact</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item text-white active">Contact</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Hero End -->


<!-- Contact Info Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 wow fadeIn">
                <div class="contact-info-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-map-marker-alt fa-3x text-dark mb-4"></i>
                        <h5 class="text-white">Office Address</h5>
                        <h6 class="fw-light text-white">Rajkot, Gujarat, India</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeIn">
                <div class="contact-info-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-phone-alt fa-3x text-dark mb-4"></i>
                        <h5 class="text-white">Call Us</h5>
                        <h6 class="fw-light text-white">+91 98765 43210</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeIn">
                <div class="contact-info-item bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-envelope fa-3x text-dark mb-4"></i>
                        <h5 class="text-white">Email Us</h5>
                        <h6 class="fw-light text-white">support@hairnic.com</h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact Info End -->


<!-- Contact Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="mx-auto text-center wow fadeIn" style="max-width: 600px;">
            <h1 class="text-primary mb-3">
                <span class="fw-light text-dark">Have Any Questions?</span> Get In Touch With Hairnic
            </h1>
            <p class="mb-4">
                We are here to help you with your hair care needs. Feel free to contact us anytime and our team will get back to you as soon as possible.
            </p>
        </div>

        <div class="row g-5">
            <div class="col-lg-7 wow fadeIn">

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                <label>Your Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                <label>Your Email</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" name="message" placeholder="Your Message" style="height: 150px" required></textarea>
                                <label>Your Message</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">
                                Send Message
                            </button>
                        </div>

                    </div>
                </form>

            </div>

            <!-- Map -->
            <div class="col-lg-5 wow fadeIn">
                <iframe class="w-100 h-100"
                    src="https://maps.google.com/maps?q=rajkot%20gujarat&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    style="min-height: 300px; border:0;" allowfullscreen loading="lazy">
                </iframe>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Newsletter Start -->
<div class="container-fluid newsletter bg-primary py-5 my-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" style="max-width: 600px;">
            <h1 class="text-white mb-3">
                <span class="fw-light text-dark">Subscribe</span> to Hairnic
            </h1>
            <p class="text-white mb-4">
                Get updates on new products, offers, and hair care tips directly in your inbox.
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
