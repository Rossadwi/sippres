<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>sippres smanband</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/landingpage/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/landingpage/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/landingpage/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/landingpage/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/landingpage/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/landingpage/css/style.css" rel="stylesheet">
</head>

<body id="home">
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <!-- <h1 class="m-0"><i class="fa fa-search me-2"></i>SIPP<span class="fs-13">re</span>S</h1> -->
                    <h1><img src="/adminlte/dist/img/sippreslogo.png" width="50px" height="50px" style="margin-right: 12px;" class="mr-7" />SIPP<span class="fs-13">re</span>S</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#home" class="nav-item nav-link">Home</a>
                        <a href="#prestasi" class="nav-item nav-link">Prestasi</a>
                        <a href="{{route('login')}}" class="nav-item nav-link">Sign in</a>

                    </div>
                </div>
            </nav>

            <div class="container-xxl py-5 hero-header mb-5" style="background-color:#02adef;">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="text-white mb-4 animated zoomIn">Sistem Informasi Data Prestasi Siswa SMA Negeri Bandarkedungmulyo Jombang</h1>
                            <p class="text-white pb-3 animated zoomIn">Sistem informasi ini memberikan akses transparan terhadap pencapaian prestasi siswa yang dapat memungkinkan pihak luar, orang tua maupun guru untuk mengetahui track records pencapaian siswa siswi SMA Negeri Bandarkedubgmulyo Jombang dengan mudah</p>

                            <a href="{{route('login')}}" class="btn btn-outline-light py-sm-3 px-sm-5 rounded-pill animated slideInRight">Sign in</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid" src="/adminlte/dist/img/beranda.png" alt="" style="width: 500px; height: 300px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- prestasi Start -->
        <div class="container-xxl py-5" id="prestasi">
            <div class="container px-lg-5">
                <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                    <!-- <h6 class="position-relative d-inline text-primary ps-4">Our Services</h6> -->
                    <h2 class="mt-4">Daftar Prestasi Terbaru</h2>
                </div>
                <div class="row g-4">
                    @foreach(json_decode($data) as $row)
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                        <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                            <!-- <div class="service-icon flex-shrink-0">
                                </div> -->
                            <!-- <i class="fa fa-home fa-2x"></i> -->
                            <img src="/prestasi/{{$row->bukti}}" alt="user-avatar" class="img-circle img-fluid">
                            <h5 class="mb-3">{{$row->nama_siswa}}-{{$row->judul}}</h5>
                            <p>{{$row->penyelenggara}}</p>
                            <!-- <a class="btn px-3 mt-auto mx-auto" href="">Read More</a> -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Footer Start -->
        <!-- <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s"> -->
        <div class="container-fluid text-light footer wow fadeIn" style="background-color:#02adef;" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <h5 class="text-white mb-4">Hubungi Kami:</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Jl. Raya Bandarkedungmulyo, Jombang</p>
                        <p><i class="fa fa-phone-alt me-3"></i>(0321) 871786</p>
                        <p><i class="fa fa-envelope me-3"></i>smanbandarkdm@gmail.com</p>
                        <div class="d-flex pt-2">
                            <!-- <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a> -->
                            <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/@smanbandarkedungmulyo"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <!-- <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a> -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">sippres</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/landingpage/lib/wow/wow.min.js"></script>
    <script src="/landingpage/lib/easing/easing.min.js"></script>
    <script src="/landingpage/lib/waypoints/waypoints.min.js"></script>
    <script src="/landingpage/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/landingpage/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="/landingpage/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="/landingpage/js/main.js"></script>
</body>

</html>