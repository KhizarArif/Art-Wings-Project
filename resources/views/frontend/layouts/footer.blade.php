<script type="text/javascript" src="js/mdb.umd.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script> 
<script>
    const navbar = document.getElementById("main-navbar")

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 0) {
            navbar.classList.add("navbar-after-scroll")
        } else {
            navbar.classList.remove("navbar-after-scroll")
        }
    })
</script>
@yield('customJs')

</body>

</html>
