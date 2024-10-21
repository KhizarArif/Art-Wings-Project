{{-- Footer Start --}}
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- About Us Column -->
            <div class="col-md-4">
                <h5>ABOUT US</h5>
                <hr class="bg-light">
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-light">Our Story</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Careers</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Contact Us</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Gift Cards</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Store Locator</a></li>
                </ul>
            </div>

            <!-- Customer Services Column -->
            <div class="col-md-4">
                <h5>CUSTOMER SERVICES</h5>
                <hr class="bg-light">
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-light">Customer Service</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Delivery & Assembly</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Gift Cards - Terms & Conditions</a>
                    </li>
                    <li><a href="#" class="text-decoration-none text-light">Installment Plan With Bank Alfalah</a>
                    </li>
                    <li><a href="#" class="text-decoration-none text-light">Warranty Activation</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="col-md-4">
                <h5>NEWSLETTER</h5>
                <hr class="bg-light">
                <p>Enter your email to receive daily news and get 20% off coupon for all items.</p>
                <form class="d-flex">
                    <input type="email" class="form-control" placeholder="Email address">
                    <button type="submit" class="btn btn-light ms-2"><i class="bi bi-send"></i></button>
                </form>
                <!-- Social Media Icons -->
                <div class="mt-3">
                    <a href="#" class="text-light me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Footer END --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const navbar = document.getElementById("main-navbar")

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 0) {
            navbar.classList.add("navbar-after-scroll")
        } else {
            navbar.classList.remove("navbar-after-scroll")
        }
    })



    function addToCart(productId, productImageId = null, feature = null) {
        console.log("productId: ", productId, "productImageId: ", productImageId);
        $.ajax({
            url: "{{ route('front.addToCart') }}",
            type: "POST",
            data: {
                id: productId,
                image_id: productImageId,
                feature: feature
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                if (response.status == true) {
                    window.location.href = "{{ route('front.cart') }}";
                } else {
                    console.log("Error");
                    toastr.error(response.message);
                }
            }
        })
    }
</script>
@yield('customJs')

</body>

</html>
