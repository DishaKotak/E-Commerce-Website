<!-- Footer Start -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')

<div class="container-fluid bg-white footer">
    <div class="container py-5">
        <div class="row g-5">

            <!-- Brand -->
            <div class="col-md-6 col-lg-3 wow fadeIn">
                <a href="#" class="d-inline-block mb-3">
                    <h1 class="text-primary">Hairnic</h1>
                </a>
                <p class="mb-0">
                    Hairnic brings you premium natural and organic hair care products designed to keep your hair strong, shiny, and healthy. Trusted by customers for safe and effective results every day.
                </p>
            </div>

            <!-- Contact -->
            <div class="col-md-6 col-lg-3 wow fadeIn">
                <h5 class="mb-4">Get In Touch</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>Rajkot, Gujarat, India</p>
                <p><i class="fa fa-phone-alt me-3"></i>+91 98765 43210</p>
                <p><i class="fa fa-envelope me-3"></i>support@hairnic.com</p>

                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-primary me-1" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-primary me-1" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-primary me-1" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square btn-outline-primary me-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Products -->
            <div class="col-md-6 col-lg-3 wow fadeIn">
                <h5 class="mb-4">Our Products</h5>
                <a class="btn btn-link" href="">Hair Shining Shampoo</a>
                <a class="btn btn-link" href="">Anti-Dandruff Shampoo</a>
                <a class="btn btn-link" href="">Anti Hair Fall Shampoo</a>
                <a class="btn btn-link" href="">Hair Growth Shampoo</a>
                <a class="btn btn-link" href="">Herbal Care Shampoo</a>
            </div>

            <!-- Links -->
            <div class="col-md-6 col-lg-3 wow fadeIn">
                <h5 class="mb-4">Quick Links</h5>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
                <a class="btn btn-link" href="">Privacy Policy</a>
                <a class="btn btn-link" href="">Terms & Conditions</a>
                <a class="btn btn-link" href="">Support</a>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="container wow fadeIn">
        <div class="copyright">
            <div class="row">

                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Hairnic</a>, All Rights Reserved.
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="">Home</a>
                        <a href="">Help</a>
                        <a href="">FAQs</a>
                        <a href="">Support</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('frontend/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<script src="{{asset('frontend/js/main.js')}}"></script>

<!-- Flash Message -->
<div id="flashMessage"
     style="position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #222;
            color: #fff;
            padding: 12px 25px;
            border-radius: 6px;
            display: none;
            z-index: 9999;">
</div>

</body>
</html>
