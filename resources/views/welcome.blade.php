<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Loccana</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('/herobiz/assets/img/brand-logo/thumb.png') }}" />
    <link href="/herobiz/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/herobiz/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/herobiz/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/herobiz/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/herobiz/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/herobiz/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href="/herobiz/assets/css/variables.css" rel="stylesheet">
    <!-- <link href="/herobiz/assets/css/variables-blue.css" rel="stylesheet"> -->
    {{-- <link href="/herobiz/assets/css/variables-green.css" rel="stylesheet"> --}}
    <!-- <link href="/herobiz/assets/css/variables-orange.css" rel="stylesheet"> -->
    <!-- <link href="/herobiz/assets/css/variables-purple.css" rel="stylesheet"> -->
    <!-- <link href="/herobiz/assets/css/variables-red.css" rel="stylesheet"> -->
    <!-- <link href="/herobiz/assets/css/variables-pink.css" rel="stylesheet"> -->

    <!-- Template Main CSS File -->
    <link href="/herobiz/assets/css/main.css" rel="stylesheet">


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <img src="/herobiz/assets/img/brand-logo/loccana.png" alt="">
                {{-- <h1>Loccana<span>.</span></h1> --}}
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto text-primary" href="#hero-animated">Home</a></li>
                    {{-- <li class="dropdown text-primary"><a href="#"><span>Produk</span> <i
                                class="bi bi-chevron-down dropdown-indicator text-primary"></i></a>
                        <ul>
                            <li><a href="#">Point Of Sales</a></li>
                            <li><a href="#">Inventory</a></li>
                            <li><a href="#">Manufacture</a></li>
                        </ul>
                    </li> --}}

                    <li><a class="nav-link scrollto text-primary" href="#about">Tentang</a></li>
                    <li><a class="nav-link scrollto text-primary" href="#services">Layanan</a></li>
                    <li><a class="nav-link scrollto text-primary" href="#pricing">Price</a></li>
                    <li><a class="nav-link scrollto text-primary" href="#contact">Kontak Kami</a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->
            @guest
                <a class="btn-getstarted scrollto" href="/login">Login/Register</a>
            @else
                <a class="btn-getstarted scrollto" href="/admin/dashboard">Administrator</a>
            @endguest

        </div>
    </header><!-- End Header -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center"
        style="background-image: url('/herobiz/assets/img/bg-annandhita.jpg')">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative"
            data-aos="zoom-out">
            <img src="/herobiz/assets/img/hero-carousel/hero-carousel-3.svg" class="img-fluid animated">
            <h2><span class="text-white fw-bold">Solusi pintar menjalankan bisnis dengan mudah dan sederhana.</span>
            </h2>
            <div class="d-flex">
                <div class="px-2">
                    <a href="/login" class="btn btn-primary btn-lg">Coba Gratis</a>
                </div>
                <div class="px-2">
                    <a href="#contact" class="btn btn-outline btn-outline-warning btn-lg">Kontak Kami</a>
                </div>
            </div>
        </div>
    </section>

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link fw-bold">MUDAH</a></h4>
                            <p>Memberikan tampilan depan outlet <span class="text-dark fw-bold">mudah</span> dipahami
                                bagi cashier dan dapat diakses melalui smartphone atau tablet.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link  fw-bold">SEDERHANA </a></h4>
                            <p>Sistem dengan konsep yang <span class="fw-bold text-dark">sederhana</span> tetapi <span
                                    class="fw-bold text-dark">berkualitas</span>.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="" class="stretched-link fw-bold">AKURAT</a></h4>
                            <p>Menjadikan data penjualan dan stok secara <span class="fw-bold text-dark">akurat</span>
                            </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                            <h4><a href="" class="stretched-link fw-bold">AMAN</a></h4>
                            <p>Memastikan data yang tersimpan aman dan dapat diunduh secara offline.</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Tentang Kami</h2>
                    <p>Loccana adalah solusi aplikasi untuk mengelola pencatatan bisnis berupa,keuangan, manufacturing,
                        inventory, distribusi, penjualan. Ayo berkembang dan sukses bersama Loccana.</p>
                </div>

                <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-12 ">

                        <ul class="nav nav-pills mb-3 justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">LOCCANA POINT OF
                                    SALES</a></li>
                            <li><a class="nav-link " data-bs-toggle="pill" href="#tab2">INVENTORY & DISTRIBUTION
                                    SYSTEM</a>
                            </li>
                            <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">MANUFACTOR</a>
                            </li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">

                                <div class="row gy-5">
                                    <h5 class="text-center fw-bold">LOCCANA POINT OF SALES</h5>
                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/efective.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">EFEKTIF </h5>
                                                </a>
                                                <p>Loccana Point of Sales memudahkan proses pendataan, penjualan, stock
                                                    barang dan operasional bisnis</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/eficience.png" class="img-fluid"
                                                width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">EFISIEN </h5>
                                                </a>
                                                <p>Loccana Point of Sales memberikan harga terbaik untuk bisnismu.</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/together.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">

                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">SATU UNTUK SEMUA </h5>
                                                </a>
                                                <p>Dapat digunakan untuk berbagai macam bisnis.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div><!-- End Tab 1 Content -->

                            <div class="tab-pane fade show" id="tab2">

                                <div class="row gy-5">
                                    <h5 class="text-center fw-bold">INVENTORY & DISTRIBUTION SYSTEM</h5>
                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/accurate.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">AKURAT</h5>
                                                </a>
                                                <p>Loccana Inventory & Distribution System memastikan data <span
                                                        class="fw-bold">akurat</span>.</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/minimalism.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">SEDERHANA </h5>
                                                </a>
                                                <p>Memberikan tampilan yang <span class="fw-bold">sederhana</span> dan
                                                    mudah di eksekusi.</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/fast.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">CEPAT</h5>
                                                </a>
                                                <p>Proses distribusi dan stoking secara <span class="fw-bold"> cepat
                                                    </span>dan <span class="fw-bold"> akurat </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="tab3">

                                <div class="row gy-5">
                                    <h5 class="text-center fw-bold">MANUFACTOR</h5>
                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/easy.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">MUDAH</h5>
                                                </a>
                                                <p>Loccana Inventory & Distribution System memastikan data <span
                                                        class="fw-bold">akurat</span>.</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/safe.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">AMAN </h5>
                                                </a>
                                                <p>Memberikan tampilan yang <span class="fw-bold">sederhana</span> dan
                                                    mudah di eksekusi.</p>
                                            </div>
                                        </div>
                                    </div><!-- End Service Item -->

                                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                                        <div class="service-item">
                                            <div class="img d-flex justify-content-center">
                                                <img src="/herobiz/assets/img/fast.png" class="img-fluid"
                                                    width="200">
                                            </div>
                                            <div class="details position-relative">
                                                <a href="#" class="stretched-link">
                                                    <h5 class="text-center fw-bold">CEPAT</h5>
                                                </a>
                                                <p>Proses distribusi dan stoking secara <span class="fw-bold"> cepat
                                                    </span>dan <span class="fw-bold"> akurat </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="zoom-out">
                <div class="section-header">
                    <h2>Partner Kami</h2>
                    <p>Berkembang dan Sukses bersama Loccana.</p>
                </div>

                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4 text-center">
                        <img src="/herobiz/assets/img/brand-logo/sdm-logo3.png" class="img-fluid" width="50%">
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="/herobiz/assets/img/brand-logo/endira-logo3.png" class="img-fluid" width="50%">
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="/herobiz/assets/img/brand-logo/celebit-logo3.png" class="img-fluid" width="50%">
                    </div>
                </div>

                {{-- <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="/herobiz/assets/img/brand-logo/sdm-logo3.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="/herobiz/assets/img/brand-logo/endira-logo3.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="/herobiz/assets/img/brand-logo/celebit-logo3.png"
                                class="img-fluid" alt=""></div>
                    </div>
                </div> --}}

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-out">

                <div class="row g-5">
                    <div
                        class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                        <h3>Owner Quotes <em>BERHASIL</em></h3>
                        <p> ~Dwi Wahyu Bintarto~.</p>
                        <a class="cta-btn align-self-start" href="#">Be a Partner</a>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                        <div class="img">
                            <img src="/herobiz/assets/img/cta.jpg" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Call To Action Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Layanan Kami</h2>
                    <p>Berkembang dan Sukses bersama Loccana.</p>
                </div>

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="/herobiz/assets/img/services-1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Inventory and Distribution Sales System</h3>
                                </a>
                                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus
                                    dolores iure perferendis.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="service-item">
                            <div class="img">
                                <img src="/herobiz/assets/img/services-2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-broadcast"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Point Of Sales</h3>
                                </a>
                                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque
                                    eum hic non ut nesciunt dolorem.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="service-item">
                            <div class="img">
                                <img src="/herobiz/assets/img/services-3.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-easel"></i>
                                </div>
                                <a href="#" class="stretched-link">
                                    <h3>Manufacturing</h3>
                                </a>
                                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id
                                    voluptas adipisci eos earum corrupti.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->


                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2 class="text-white fw-bold">Testimonials</h2>
                </div>
                <div class="testimonials-slider swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="/herobiz/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Saul Goodman</h3>
                                <h4>Ceo &amp; Founder</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="/herobiz/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                    cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                    legam anim culpa.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="/herobiz/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                    veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                    minim.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="/herobiz/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                    alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                    dolore labore illum veniam.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="/herobiz/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                    alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                    veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                    culpa fore nisi cillum quid.
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h5 class="fw-bold">Pakai Loccana sekarang dan dapatkan harga terbaik.</h5>
                </div>

                <div class="row gy-4">

                    <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pricing-item">

                            <div class="pricing-header bg-secondary">
                                <h3>Basic</h3>
                                <h4><sup>Rp</sup> 99 <span>Ribu <br>/Bulan</span></h4>
                            </div>

                            <ul>
                                <li><i class="bi bi-dot"></i> <span>Outlet </span></li>
                                <li><i class="bi bi-dot"></i> <span>Metode Pembayaran Offline</span></li>
                                <li><i class="bi bi-dot"></i> <span>Kasir Digital</span></li>
                                <li><i class="bi bi-dot"></i> <span>Dashbord & Laporan Penjualan</span></li>
                                <li><i class="bi bi-dot"></i> <span>Pembayaran Transaksi</span></li>
                                <li><i class="bi bi-x"></i> <span>Fitur Modifikasi Harga </span>
                                <li><i class="bi bi-x"></i> <span>Menu Order</span>
                                </li>
                                <li><i class="bi bi-x"></i> <span>Finance</span></li>
                                <li><i class="bi bi-x"></i> <span>Piutang</span>
                                <li><i class="bi bi-x"></i> <span>Purchase Order</span>
                                <li><i class="bi bi-x"></i> <span>Inventory</span>
                            </ul>

                            <div class="text-center mt-auto">
                                <a href="#" class="buy-btn">Buy Now</a>
                            </div>

                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                        <div class="pricing-item ">

                            <div class="pricing-header bg-success">
                                <h3>Standard</h3>
                                <h4><sup>Rp</sup>129<span>Ribu /Bulan</span></h4>
                            </div>

                            <ul>
                                <li><i class="bi bi-dot"></i> <span>Outlet </span></li>
                                <li><i class="bi bi-dot"></i> <span>Metode Pembayaran Offline & Online</span></li>
                                <li><i class="bi bi-dot"></i> <span>Kasir Digital</span></li>
                                <li><i class="bi bi-dot"></i> <span>Dashbord & Laporan Penjualan</span></li>
                                <li><i class="bi bi-dot"></i> <span>Pembayaran Transaksi</span></li>
                                <li><i class="bi bi-dot"></i> <span>Fitur Modifikasi Harga </span>
                                <li><i class="bi bi-dot"></i> <span>Menu Order</span>
                                </li>
                                <li><i class="bi bi-x"></i> <span>Finance</span></li>
                                <li><i class="bi bi-x"></i> <span>Piutang</span>
                                <li><i class="bi bi-x"></i> <span>Purchase Order</span>
                                <li><i class="bi bi-x"></i> <span>Inventory</span>
                            </ul>


                            <div class="text-center mt-auto">
                                <a href="#" class="buy-btn">Buy Now</a>
                            </div>

                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="600">
                        <div class="pricing-item">

                            <div class="pricing-header bg-primary">
                                <h3>Pro</h3>
                                <h4><sup>Rp</sup>387<span>Ribu /Bulan</span></h4>
                            </div>

                            <ul>
                                <li><i class="bi bi-dot"></i> <span>Outlet </span></li>
                                <li><i class="bi bi-dot"></i> <span>Metode Pembayaran Offline & Online</span></li>
                                <li><i class="bi bi-dot"></i> <span>Kasir Digital</span></li>
                                <li><i class="bi bi-dot"></i> <span>Dashbord & Laporan Penjualan</span></li>
                                <li><i class="bi bi-dot"></i> <span>Pembayaran Transaksi</span></li>
                                <li><i class="bi bi-dot"></i> <span>Fitur Modifikasi Harga </span>
                                <li><i class="bi bi-dot"></i> <span>Menu Order</span>
                                </li>
                                <li><i class="bi bi-dot"></i> <span>Finance</span></li>
                                <li><i class="bi bi-x"></i> <span>Piutang</span>
                                <li><i class="bi bi-dot"></i> <span>Purchase Order</span>
                                <li><i class="bi bi-dot"></i> <span>Inventory</span>
                            </ul>

                            <div class="text-center mt-auto">
                                <a href="#" class="buy-btn">Buy Now</a>
                            </div>

                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="600">
                        <div class="pricing-item">

                            <div class="pricing-header bg-warning">
                                <h3>Premium</h3>
                                <h4><sup>Rp</sup>649<span>Ribu /Bulan</span></h4>
                            </div>

                            <ul>
                                <li><i class="bi bi-dot"></i> <span>Outlet </span></li>
                                <li><i class="bi bi-dot"></i> <span>Metode Pembayaran Offline & Online</span></li>
                                <li><i class="bi bi-dot"></i> <span>Kasir Digital</span></li>
                                <li><i class="bi bi-dot"></i> <span>Dashbord & Laporan Penjualan</span></li>
                                <li><i class="bi bi-dot"></i> <span>Pembayaran Transaksi</span></li>
                                <li><i class="bi bi-dot"></i> <span>Fitur Modifikasi Harga </span>
                                <li><i class="bi bi-dot"></i> <span>Menu Order</span>
                                </li>
                                <li><i class="bi bi-dot"></i> <span>Finance</span></li>
                                <li><i class="bi bi-dot"></i> <span>Piutang</span>
                                <li><i class="bi bi-dot"></i> <span>Purchase Order</span>
                                <li><i class="bi bi-dot"></i> <span>Inventory</span>
                            </ul>

                            <div class="text-center mt-auto">
                                <a href="#" class="buy-btn">Buy Now</a>
                            </div>

                        </div>
                    </div><!-- End Pricing Item -->

                </div>

                <div class="col-lg-12 ">
                  <div class="pricing-item ">

                    <div class="pricing-header bg-primary">
                        <h3 class="fw-bold">CUSTOM</h3>
                        <hr>
                        <h4>Mulai dari </h4>
                        <h4><sup>Rp</sup> 1,500 <span>Ribu /Bulan</span></h4>
                    </div>
                </div>
                </div>
            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Team</h2>
                    <p>Loccana Team</p>
                </div>

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/herobiz/assets/img/team/team-1.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                                <h4>Dwi Wahyu Bintarto</h4>
                                <span>Database Administrator</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/herobiz/assets/img/team/team-3.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                                <h4>Ega Nugraha</h4>
                                <span>Developer</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="600">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/herobiz/assets/img/team/team-2.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                                <h4>Annandhita</h4>
                                <span>Sales Marketing</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>
        </section><!-- End Team Section -->



        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-header">
                    <h2>Kontak Kami</h2>
                    <p></p>
                </div>

            </div>

            <div class="container">

                <div class="row gy-5 gx-lg-5">

                    <div class="col-lg-4">

                        <div class="info">
                            <h3>Punya Pertanyaan ?</h3>
                            <p>Tim kami selalu siap dalam 1x8 jam untuk melayani.</p>

                            <div class="info-item d-flex">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h4>Lokasi :</h4>
                                    <p>PT. Swamedia Informatika Jl. Sidomulyo No. 29-31, Bandung, Jawa Barat</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <p>@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-phone flex-shrink-0"></i>
                                <div>
                                    <h4>Call:</h4>
                                    <p>+6285719160602</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form onsubmit="sendEmail()" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <input type="text" class="form-control" name="nohp" id="nohp"
                                    placeholder="Nomor Handphone" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" id="message" placeholder="Message" required></textarea>
                            </div>

                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>Loccana</h3>
                            <p>
                                PT. Swamedia Informatika <br>
                                Jl. Sidomulyo No. 29-31,<br>
                                Bandung, Jawa Barat <br>
                                <strong>Phone:</strong> +6285719160602<br>
                                <strong>Email:</strong> @gmail.com<br>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#hero-animated">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Pelayanan</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#team">Team</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Web Design</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Web Development</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Product Management</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Marketing</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>@gmail.com</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal text-center">
            <div
                class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

                <div class="d-flex flex-column align-items-center align-items-lg-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Loccana</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="#team">Loccana Team</a>
                    </div>
                </div>

                <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>

            </div>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="/herobiz/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/herobiz/assets/vendor/aos/aos.js"></script>
    <script src="/herobiz/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/herobiz/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/herobiz/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/herobiz/assets/vendor/php-email-form/validate.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="/herobiz/assets/js/main.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            var templateParams = {
                from_name: document.getElementById('name').value,
                from_email: document.getElementById('email').value,
                from_nohp: document.getElementById('nohp').value,
                message: document.getElementById('message').value
            };

            emailjs.send('service_9ryv19d', 'template_xcknhhy', templateParams, 'P-zRLmHcpN0ftofjI');

            Swal.fire({
                title: 'Email Sudah Dikirim.',
                text: "Mohon Tunggu Balasan Dari Kami Ya.",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            })

        }
    </script>




</body>

</html>
